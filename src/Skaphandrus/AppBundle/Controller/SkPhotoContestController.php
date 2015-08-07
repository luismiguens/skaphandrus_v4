<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoContest;
use Skaphandrus\AppBundle\Form\SkPhotoContestType;

/**
 * SkPhotoContest controller.
 *
 */
class SkPhotoContestController extends Controller
{

    /**
     * Lists all SkPhotoContest entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoContest entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoContest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhotoContest entity.
     *
     * @param SkPhotoContest $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoContest $entity)
    {
        $form = $this->createForm(new SkPhotoContestType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoContest entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPhotoContest();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoContest entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoContest entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContest entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoContest entity.
    *
    * @param SkPhotoContest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoContest $entity)
    {
        $form = $this->createForm(new SkPhotoContestType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
//@LM
//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoContest entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPhotoContest entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContest entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_contest_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoContest entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_contest_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
