<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation;
use Skaphandrus\AppBundle\Form\SkPhotoContestCategoryJudgeVotationType;

/**
 * SkPhotoContestCategoryJudgeVotation controller.
 *
 */
class SkPhotoContestCategoryJudgeVotationController extends Controller {

    /**
     * Lists all SkPhotoContestCategory entities.
     *
     */
    public function categoriesAction($contest_id) {
        $em = $this->getDoctrine()->getManager();

        $contest = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneById($contest_id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:indexCategory.html.twig', array(
                    'contest' => $contest,
                    'categories' => $contest->getCategories(),
        ));
    }
    
    /**
     * Lists all SkPhotoContestCategoryJudgeVotation entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkPhotoContestCategoryJudgeVotation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('votation_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhotoContestCategoryJudgeVotation entity.
     *
     * @param SkPhotoContestCategoryJudgeVotation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoContestCategoryJudgeVotation $entity) {
        $form = $this->createForm(new SkPhotoContestCategoryJudgeVotationType(), $entity, array(
            'action' => $this->generateUrl('votation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function newAction() {
        $entity = new SkPhotoContestCategoryJudgeVotation();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function showAction($contest_id, $category_id) {
        $em = $this->getDoctrine()->getManager();

        $contest = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneById($contest_id);
        
        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                ->findOneById($category_id);
        
        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->findPhotos($category->getId());

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:show.html.twig', array(
                    'contest' => $contest,
                    'categories' => $contest->getCategories(),
                    'entities' => $entities,
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkPhotoContestCategoryJudgeVotation entity.
     *
     * @param SkPhotoContestCategoryJudgeVotation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkPhotoContestCategoryJudgeVotation $entity) {
        $form = $this->createForm(new SkPhotoContestCategoryJudgeVotationType(), $entity, array(
            'action' => $this->generateUrl('votation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('votation_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('votation'));
    }

    /**
     * Creates a form to delete a SkPhotoContestCategoryJudgeVotation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('votation_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
