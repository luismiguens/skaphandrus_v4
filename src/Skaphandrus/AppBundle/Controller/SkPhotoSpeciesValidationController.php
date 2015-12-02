<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation;
use Skaphandrus\AppBundle\Form\SkPhotoSpeciesValidationType;

use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkPhotoSpeciesValidation controller.
 *
 */
class SkPhotoSpeciesValidationController extends Controller
{

    /**
     * Lists all SkPhotoSpeciesValidation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesValidation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoSpeciesValidation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoSpeciesValidation();
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
     * Creates a form to create a SkPhotoSpeciesValidation entity.
     *
     * @param SkPhotoSpeciesValidation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoSpeciesValidation $entity, $photo_id = NULL)
    {
        $form = $this->createForm(new SkPhotoSpeciesValidationType(), $entity, array(
            'action' => $this->generateUrl('photo_species_validation_admin_create', array('photo_id' => $photo_id)),
            'method' => 'POST',
        ));

        // $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoSpeciesValidation entity.
     *
     */
    public function newAction($photo_id)
    {
        $entity = new SkPhotoSpeciesValidation();
        $form   = $this->createCreateForm($entity, $photo_id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesValidation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoSpeciesValidation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesValidation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesValidation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoSpeciesValidation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesValidation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesValidation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoSpeciesValidation entity.
    *
    * @param SkPhotoSpeciesValidation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoSpeciesValidation $entity)
    {
        $form = $this->createForm(new SkPhotoSpeciesValidationType(), $entity, array(
            'action' => $this->generateUrl('photo_species_validation_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoSpeciesValidation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoSpeciesValidation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));
        }
        return $this->redirect($this->generateUrl('photo', array('id' => $entity->getPhoto()->getId(), 'slug' => Utils::slugify($entity->getPhoto()->getTitle()))));

        // return $this->render('SkaphandrusAppBundle:SkPhotoSpeciesValidation:edit.html.twig', array(
        //     'entity'      => $entity,
        //     'edit_form'   => $editForm->createView(),
        //     'delete_form' => $deleteForm->createView(),
        // ));
    }
    /**
     * Deletes a SkPhotoSpeciesValidation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoSpeciesValidation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_species_validation_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoSpeciesValidation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_species_validation_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
