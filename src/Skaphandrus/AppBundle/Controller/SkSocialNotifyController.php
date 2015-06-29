<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkSocialNotify;
use Skaphandrus\AppBundle\Form\SkSocialNotifyType;

/**
 * SkSocialNotify controller.
 *
 */
class SkSocialNotifyController extends Controller
{

    /**
     * Lists all SkSocialNotify entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findAll();

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkSocialNotify entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkSocialNotify();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('notify_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkSocialNotify entity.
     *
     * @param SkSocialNotify $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkSocialNotify $entity)
    {
        $form = $this->createForm(new SkSocialNotifyType(), $entity, array(
            'action' => $this->generateUrl('notify_admin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkSocialNotify entity.
     *
     */
    public function newAction()
    {
        $entity = new SkSocialNotify();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkSocialNotify entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSocialNotify entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkSocialNotify entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSocialNotify entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkSocialNotify entity.
    *
    * @param SkSocialNotify $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkSocialNotify $entity)
    {
        $form = $this->createForm(new SkSocialNotifyType(), $entity, array(
            'action' => $this->generateUrl('notify_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkSocialNotify entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSocialNotify entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('notify_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkSocialNotify:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkSocialNotify entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkSocialNotify entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notify_admin'));
    }

    /**
     * Creates a form to delete a SkSocialNotify entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notify_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
