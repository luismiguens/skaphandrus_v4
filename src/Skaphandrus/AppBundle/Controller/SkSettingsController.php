<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Form\FosUserSettingsType;

/**
 * SkSettings controller.
 *
 */
class SkSettingsController extends Controller {
    /**
     * Lists all SkSettings entities.
     *
     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkSettings')->findAll();
//
//        return $this->render('SkaphandrusAppBundle:SkSettings:index.html.twig', array(
//            'entities' => $entities,
//        ));
//    }
    /**
     * Creates a new SkSettings entity.
     *
     */
//    public function createAction(Request $request)
//    {
//        $entity = new SkSettings();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('settings_admin_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkSettings:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }

    /**
     * Creates a form to create a SkSettings entity.
     *
     * @param SkSettings $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createCreateForm(SkSettings $entity)
//    {
//        $form = $this->createForm(new SkSettingsType(), $entity, array(
//            'action' => $this->generateUrl('settings_admin_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }

    /**
     * Displays a form to create a new SkSettings entity.
     *
     */
//    public function newAction()
//    {
//        $entity = new SkSettings();
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('SkaphandrusAppBundle:SkSettings:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }

    /**
     * Finds and displays a SkSettings entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkSettings')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkSettings entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkSettings:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkSettings entity.
     *
     */
    public function editAction() {



        ##@LM
        $entity = $this->get('security.token_storage')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }
        $editForm = $this->createEditForm($entity);

        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkSettings:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkSettings entity.
     *
     * @param SkSettings $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(FosUser $entity) {
        $form = $this->createForm(new FosUserSettingsType(), $entity, array(
            'action' => $this->generateUrl('settings_admin_update'),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkSettings entity.
     *
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($id);
        $entity = $this->get('security.token_storage')->getToken()->getUser();


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('settings_admin_edit'));
        }

        return $this->render('SkaphandrusAppBundle:SkSettings:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                   
        ));
    }

    /**
     * Deletes a SkSettings entity.
     *
     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('SkaphandrusAppBundle:SkSettings')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find SkSettings entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('settings_admin'));
//    }

    /**
     * Creates a form to delete a SkSettings entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('settings_admin_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
//            ->getForm()
//        ;
//    }
}
