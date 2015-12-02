<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkCourseAffiliation;
use Skaphandrus\AppBundle\Form\SkCourseAffiliationType;

/**
 * SkCourseAffiliation controller.
 *
 */
class SkCourseAffiliationController extends Controller {

    /**
     * Lists all SkCourseAffiliation entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkCourseAffiliation')->findAll();

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkCourseAffiliation entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkCourseAffiliation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('course_affiliation_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkCourseAffiliation entity.
     *
     * @param SkCourseAffiliation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkCourseAffiliation $entity) {
        $form = $this->createForm(new SkCourseAffiliationType(), $entity, array(
            'action' => $this->generateUrl('course_affiliation_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkCourseAffiliation entity.
     *
     */
    public function newAction() {
        $entity = new SkCourseAffiliation();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkCourseAffiliation entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCourseAffiliation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCourseAffiliation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkCourseAffiliation entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCourseAffiliation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCourseAffiliation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkCourseAffiliation entity.
     *
     * @param SkCourseAffiliation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkCourseAffiliation $entity) {
        $form = $this->createForm(new SkCourseAffiliationType(), $entity, array(
            'action' => $this->generateUrl('course_affiliation_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkCourseAffiliation entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkCourseAffiliation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkCourseAffiliation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('course_affiliation_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkCourseAffiliation:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkCourseAffiliation entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkCourseAffiliation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkCourseAffiliation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('course_affiliation_admin'));
    }

    /**
     * Creates a form to delete a SkCourseAffiliation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('course_affiliation_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
