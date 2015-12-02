<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoContestAward;
use Skaphandrus\AppBundle\Form\SkPhotoContestAwardType;

/**
 * SkPhotoContestAward controller.
 *
 */
class SkPhotoContestAwardController extends Controller
{

    /**
     * Lists all SkPhotoContestAward entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestAward')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoContestAward entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoContestAward();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_award_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhotoContestAward entity.
     *
     * @param SkPhotoContestAward $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoContestAward $entity)
    {
        $form = $this->createForm(new SkPhotoContestAwardType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_award_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoContestAward entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPhotoContestAward();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoContestAward entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestAward')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestAward entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoContestAward entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestAward')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestAward entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoContestAward entity.
    *
    * @param SkPhotoContestAward $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoContestAward $entity)
    {
        $form = $this->createForm(new SkPhotoContestAwardType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_award_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoContestAward entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestAward')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestAward entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('photo_contest_award_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestAward:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPhotoContestAward entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestAward')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContestAward entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_contest_award_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoContestAward entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_contest_award_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
