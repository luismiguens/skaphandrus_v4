<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkRegion;
use Skaphandrus\AppBundle\Form\SkRegionType;

/**
 * SkRegion controller.
 *
 */
class SkRegionController extends Controller {

    /**
     * Lists all SkRegion entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkRegion')->findAll();

        return $this->render('SkaphandrusAppBundle:SkRegion:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkRegion entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkRegion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('region_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkRegion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkRegion entity.
     *
     * @param SkRegion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkRegion $entity) {
        $form = $this->createForm(new SkRegionType(), $entity, array(
            'action' => $this->generateUrl('region_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkRegion entity.
     *
     */
    public function newAction() {
        $entity = new SkRegion();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkRegion:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkRegion entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkRegion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkRegion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkRegion:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkRegion entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkRegion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkRegion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkRegion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkRegion entity.
     *
     * @param SkRegion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkRegion $entity) {
        $form = $this->createForm(new SkRegionType(), $entity, array(
            'action' => $this->generateUrl('region_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkRegion entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkRegion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkRegion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('region_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkRegion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkRegion entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkRegion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkRegion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('region_admin'));
    }

    /**
     * Creates a form to delete a SkRegion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('region_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
