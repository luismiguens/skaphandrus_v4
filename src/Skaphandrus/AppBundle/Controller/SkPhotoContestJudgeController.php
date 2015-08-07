<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoContestJudge;
use Skaphandrus\AppBundle\Form\SkPhotoContestJudgeType;

/**
 * SkPhotoContestJudge controller.
 *
 */
class SkPhotoContestJudgeController extends Controller
{

    /**
     * Lists all SkPhotoContestJudge entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoContestJudge entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoContestJudge();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_judge_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhotoContestJudge entity.
     *
     * @param SkPhotoContestJudge $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoContestJudge $entity)
    {
        $form = $this->createForm(new SkPhotoContestJudgeType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_judge_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoContestJudge entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPhotoContestJudge();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoContestJudge entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestJudge entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoContestJudge entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestJudge entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoContestJudge entity.
    *
    * @param SkPhotoContestJudge $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoContestJudge $entity)
    {
        $form = $this->createForm(new SkPhotoContestJudgeType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_judge_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoContestJudge entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestJudge entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_judge_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestJudge:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPhotoContestJudge entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContestJudge entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_contest_judge_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoContestJudge entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_contest_judge_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
