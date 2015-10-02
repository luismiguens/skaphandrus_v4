<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaGroup;
use Skaphandrus\AppBundle\Form\SkIdentificationCriteriaGroupType;

/**
 * SkIdentificationCriteriaGroup controller.
 *
 */
class SkIdentificationCriteriaGroupController extends Controller {

    /**
     * Lists all SkIdentificationCriteriaGroup entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteriaGroup')->findAll();

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkIdentificationCriteriaGroup entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkIdentificationCriteriaGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sk_identification_criteria_group_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkIdentificationCriteriaGroup entity.
     *
     * @param SkIdentificationCriteriaGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkIdentificationCriteriaGroup $entity) {
        $form = $this->createForm(new SkIdentificationCriteriaGroupType(), $entity, array(
            'action' => $this->generateUrl('sk_identification_criteria_group_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkIdentificationCriteriaGroup entity.
     *
     */
    public function newAction() {
        $entity = new SkIdentificationCriteriaGroup();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkIdentificationCriteriaGroup entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteriaGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationCriteriaGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkIdentificationCriteriaGroup entity.
     *
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteriaGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationCriteriaGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkIdentificationCriteriaGroup entity.
     *
     * @param SkIdentificationCriteriaGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkIdentificationCriteriaGroup $entity) {
        $form = $this->createForm(new SkIdentificationCriteriaGroupType(), $entity, array(
            'action' => $this->generateUrl('sk_identification_criteria_group_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkIdentificationCriteriaGroup entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteriaGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationCriteriaGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sk_identification_criteria_group_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteriaGroup:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkIdentificationCriteriaGroup entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteriaGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkIdentificationCriteriaGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sk_identification_criteria_group'));
    }

    /**
     * Creates a form to delete a SkIdentificationCriteriaGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('sk_identification_criteria_group_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
