<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkCountry;
use Skaphandrus\AppBundle\Form\SkCountryType;

/**
 * SkCountry controller.
 *
 */
class SkCountryController extends Controller {

    /**
     * Lists all SkCountry entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkCountry')->findAll();

        return $this->render('SkaphandrusAppBundle:SkCountry:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkCountry entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkCountry();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('country_admin_edit', array('id' => $entity->getId())));
        }
        
        $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

        return $this->render('SkaphandrusAppBundle:SkCountry:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkCountry entity.
     *
     * @param SkCountry $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkCountry $entity) {
        $form = $this->createForm(new SkCountryType(), $entity, array(
            'action' => $this->generateUrl('country_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkCountry entity.
     *
     */
    public function newAction() {
        $entity = new SkCountry();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkCountry:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkCountry entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCountry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkCountry:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkCountry entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCountry entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkCountry:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkCountry entity.
     *
     * @param SkCountry $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkCountry $entity) {
        $form = $this->createForm(new SkCountryType(), $entity, array(
            'action' => $this->generateUrl('country_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkCountry entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCountry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('country_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkCountry:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkCountry entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkCountry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkCountry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('country_admin'));
    }

    /**
     * Creates a form to delete a SkCountry entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('country_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
