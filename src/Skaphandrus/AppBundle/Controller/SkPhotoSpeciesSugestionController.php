<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion;
use Skaphandrus\AppBundle\Form\SkPhotoSpeciesSugestionType;

use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkPhotoSpeciesSugestion controller.
 *
 */
class SkPhotoSpeciesSugestionController extends Controller
{

    /**
     * Lists all SkPhotoSpeciesSugestion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesSugestion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoSpeciesSugestion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoSpeciesSugestion();
        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($request->query->get('photo_id'));
        $entity->setPhoto($photo);
        $entity->setFosUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));
        }
        return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));
    }

    /**
     * Creates a form to create a SkPhotoSpeciesSugestion entity.
     *
     * @param SkPhotoSpeciesSugestion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoSpeciesSugestion $entity, $photo_id = NULL)
    {
        $form = $this->createForm(new SkPhotoSpeciesSugestionType(), $entity, array(
            'action' => $this->generateUrl('photo_species_sugestion_admin_create', array('photo_id' => $photo_id)),
            'method' => 'POST',
        ));

        // $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoSpeciesSugestion entity.
     *
     */
    public function newAction($photo_id)
    {
        $entity = new SkPhotoSpeciesSugestion();
        $form   = $this->createCreateForm($entity, $photo_id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesSugestion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoSpeciesSugestion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesSugestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesSugestion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoSpeciesSugestion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesSugestion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesSugestion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoSpeciesSugestion entity.
    *
    * @param SkPhotoSpeciesSugestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoSpeciesSugestion $entity)
    {
        $form = $this->createForm(new SkPhotoSpeciesSugestionType(), $entity, array(
            'action' => $this->generateUrl('photo_species_sugestion_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoSpeciesSugestion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesSugestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));
        }
        return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));

        // return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesSugestion:edit.html.twig', array(
        //     'entity'      => $entity,
        //     'edit_form'   => $editForm->createView(),
        //     'delete_form' => $deleteForm->createView(),
        // ));
    }
    /**
     * Deletes a SkPhotoSpeciesSugestion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoSpeciesSugestion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_species_sugestion_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoSpeciesSugestion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_species_sugestion_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
