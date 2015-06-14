<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkIdentificationGroup;
use Skaphandrus\AppBundle\Form\SkIdentificationGroupType;

/**
 * SkIdentificationGroup controller.
 *
 */
class SkIdentificationGroupController extends Controller
{

    /**
     * Lists all SkIdentificationGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->findAll();

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkIdentificationGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkIdentificationGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('identification_group_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkIdentificationGroup entity.
     *
     * @param SkIdentificationGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkIdentificationGroup $entity)
    {
        $form = $this->createForm(new SkIdentificationGroupType(), $entity, array(
            'action' => $this->generateUrl('identification_group_admin_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkIdentificationGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new SkIdentificationGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkIdentificationGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkIdentificationGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkIdentificationGroup entity.
    *
    * @param SkIdentificationGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkIdentificationGroup $entity)
    {
        $form = $this->createForm(new SkIdentificationGroupType(), $entity, array(
            'action' => $this->generateUrl('identification_group_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkIdentificationGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('identification_group_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkIdentificationGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkIdentificationGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('identification_group_admin'));
    }

    /**
     * Creates a form to delete a SkIdentificationGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('identification_group_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
