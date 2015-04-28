<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhoto;
use Skaphandrus\AppBundle\Form\SkPhotoType;

/**
 * SkPhoto controller.
 *
 */
class SkPhotoController extends Controller
{

    /**
     * Lists all SkPhoto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhoto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhoto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhoto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhoto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhoto entity.
     *
     * @param SkPhoto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhoto $entity)
    {
        $form = $this->createForm(new SkPhotoType(), $entity, array(
            'action' => $this->generateUrl('photo_admin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhoto entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPhoto();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhoto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhoto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhoto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhoto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhoto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhoto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhoto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhoto entity.
    *
    * @param SkPhoto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhoto $entity)
    {
        $form = $this->createForm(new SkPhotoType(), $entity, array(
            'action' => $this->generateUrl('photo_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhoto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
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

            return $this->redirect($this->generateUrl('photo_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhoto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPhoto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
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
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
