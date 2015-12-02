<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPhotoContestCategory;
use Skaphandrus\AppBundle\Form\SkPhotoContestCategoryType;

/**
 * SkPhotoContestCategory controller.
 *
 */
class SkPhotoContestCategoryController extends Controller
{

    /**
     * Lists all SkPhotoContestCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findAll();

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPhotoContestCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPhotoContestCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('photo_contest_category_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPhotoContestCategory entity.
     *
     * @param SkPhotoContestCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPhotoContestCategory $entity)
    {
        $form = $this->createForm(new SkPhotoContestCategoryType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_category_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPhotoContestCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPhotoContestCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPhotoContestCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPhotoContestCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPhotoContestCategory entity.
    *
    * @param SkPhotoContestCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPhotoContestCategory $entity)
    {
        $form = $this->createForm(new SkPhotoContestCategoryType(), $entity, array(
            'action' => $this->generateUrl('photo_contest_category_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPhotoContestCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('photo_contest_category_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPhotoContestCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContestCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('photo_contest_category_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoContestCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('photo_contest_category_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
