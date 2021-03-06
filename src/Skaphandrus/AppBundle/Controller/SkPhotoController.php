<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkPhoto;
use Skaphandrus\AppBundle\Utils\Utils;
use Skaphandrus\AppBundle\Entity\SkKeyword;
use Skaphandrus\AppBundle\Form\SkPhotoType;

/**
 * SkPhoto controller.
 *
 */
class SkPhotoController extends Controller {

    /**
     * Lists all SkPhoto entities.
     *
     */
    public function indexAction(Request $request) {

        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
//        $params = array($fos_user->getId());
        $params = $request->query->all();

        $contests = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findBy(array('isVisible' => true), array('beginAt' => 'DESC'));

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getUserSpeciesFromPhotos($fos_user->getId());

        $tags = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getUserTagsFromPhotos($fos_user->getId());

//        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getQueryBuilder4($params, 20);
        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getUserPhotos($fos_user->getId(), $params, 21);
        $query = $qb->getQuery();

//        dump($tags);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->getInt('page', 1)/* page number */, 21/* limit per page */
        );

        // parameters to template
        return $this->render('SkaphandrusAppBundle:SkPhoto:index.html.twig', array(
                    'species' => $species,
                    'tags' => $tags,
                    'contests' => $contests,
                    'pagination' => $pagination,
                    'params' => $params
        ));

//        $em = $this->getDoctrine()->getManager();
//
//        ##@LM
//        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findByFosUser($fos_user );
//
//        return $this->render('SkaphandrusAppBundle:SkPhoto:index.html.twig', array(
//                    'entities' => $entities,
//        ));
    }

    /**
     * Creates a new SkPhoto entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkPhoto();

        ##@LM
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $entity->setFosUser($fos_user);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($request->request->get('tags') != NULL and $request->request->get('tags') != ""):

                // Add tags from custom field
                $tags = explode(',', $request->request->get('tags'));
                foreach ($tags as $tag) {
                    $keyword = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkKeyword')
                            ->findLikeKeyword($tag);

                    if (!$keyword) {
                        $keyword = new SkKeyword();
                        $keyword->setKeyword($tag);

                        $em->persist($keyword);
                        $em->flush();
                    }
                    $entity->addKeyword($keyword);
                }
            endif;
            $em->persist($entity);
            $em->flush();

            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

            return $this->redirect($this->generateUrl('photo_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhoto:new.html.twig', array(
                    'entity' => $entity,
                    'keywords' => explode(',', $request->request->get('tags')),
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhoto entity.
     *
     * @param SkPhoto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhoto $entity) {
        $form = $this->createForm(new SkPhotoType(), $entity, array(
            'action' => $this->generateUrl('photo_admin_create'),
            'method' => 'POST',
        ));

        ##@LM
        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhoto entity.
     *
     */
    public function newAction() {
        $entity = new SkPhoto();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhoto:new.html.twig', array(
                    'entity' => $entity,
                    'keywords' => array(),
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhoto entity.
     *
     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkPhoto entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkPhoto:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkPhoto entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);

        $loggedUser = $this->get('security.token_storage')->getToken()->getUser();
        $owner = $entity->getFosUser();

        if (Utils::isOwner($loggedUser, $owner)) {
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhoto entity.');
            }

            $editForm = $this->createEditForm($entity);
            //$editForm->remove('file');  


            $deleteForm = $this->createDeleteForm($id);

            $keywords = array();
            foreach ($entity->getKeyword() as $keyword) {
                $keywords[] = $keyword->getKeyword();
            }

            return $this->render('SkaphandrusAppBundle:SkPhoto:edit.html.twig', array(
                        'entity' => $entity,
                        'keywords' => $keywords,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        } else {
            throw $this->createAccessDeniedException('Unauthorised access!');
//            throw $this->createNotFoundException("The content isn't yours.");
        }
    }

    /**
     * Creates a form to edit a SkPhoto entity.
     *
     * @param SkPhoto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkPhoto $entity) {
        $form = $this->createForm(new SkPhotoType(), $entity, array(
            'action' => $this->generateUrl('photo_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        ##@LM
        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkPhoto entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhoto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

//            $entity->upload();
            // Add tags from custom field
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);
            $tags = explode(',', $request->request->get('tags'));

            foreach ($entity->getKeyword() as $keyword) {
                $entity->removeKeyword($keyword);
            }

            foreach ($tags as $tag) {
                $keyword = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkKeyword')
                        ->findLikeKeyword($tag);

                if (!$keyword) {
                    $keyword = new SkKeyword();
                    $keyword->setKeyword($tag);

                    $em->persist($keyword);
                    $em->flush();
                }
                $entity->addKeyword($keyword);
            }

            $em->persist($entity);
            $em->flush();

            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

            return $this->redirect($this->generateUrl('photo_admin_edit', array('id' => $id)));
        }

        $keywords = array();
        foreach ($entity->getKeyword() as $keyword) {
            $keywords[] = $keyword->getKeyword();
        }

        return $this->render('SkaphandrusAppBundle:SkPhoto:edit.html.twig', array(
                    'entity' => $entity,
                    'keywords' => $keywords,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkPhoto entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhoto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_admin'));
    }

    /**
     * Creates a form to delete a SkPhoto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('photo_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
