<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Form\SkBusinessSettingsType;

/**
 * SkBusiness controller.
 *
 */
class SkBusinessSettingsController extends Controller {
//    /**
//     * Lists all SkBusiness entities.
//     *
//     */
//    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//        $locale = $this->get('request')->getLocale();
//
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllBusiness($locale);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:index.html.twig', array(
//                    'entities' => $entities,
//        ));
//    }
//
//    /**
//     * Creates a new SkBusiness entity.
//     *
//     */
//    public function createAction(Request $request) {
//        $entity = new SkBusiness();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $entity->getId())));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to create a SkBusiness entity.
//     *
//     * @param SkBusiness $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createCreateForm(SkBusiness $entity) {
//        $form = $this->createForm(new SkBusinessType(), $entity, array(
//            'action' => $this->generateUrl('business_admin_create'),
//            'method' => 'POST',
//        ));
//
////        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }
//
//    /**
//     * Displays a form to create a new SkBusiness entity.
//     *
//     */
//    public function newAction() {
//        $entity = new SkBusiness();
//        $form = $this->createCreateForm($entity);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a SkBusiness entity.
//     *
//     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkBusiness entity.
     *
     */
    public function editAction($id) {

        $loggedUser = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        // verifica se o user é admin e se o user é admin do business
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser) || $entity->isUserAdminFromBusiness($loggedUser)) {

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('SkaphandrusAppBundle:SkBusinessSettings:edit.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        } else {
            throw $this->createAccessDeniedException('Unauthorised access!');
//            return $this->redirect($this->generateUrl('error403'));
//            return $this->render('SkaphandrusAppBundle:Common:error403.html.twig');
        }
    }

    /**
     * Creates a form to edit a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkBusiness $entity) {
        $form = $this->createForm(new SkBusinessSettingsType($entity), $entity, array(
            'action' => $this->generateUrl('business_settings_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkBusiness entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        //$entity = new SkBusiness();
        //para funcionar com multiple select checkboxes
        //necessário criar o método clear
        $entity->clearAdmins();
        $data = $request->get('skaphandrus_appbundle_skbusiness');
        if (isset($data['adminChoices'])) {
            foreach ($data['adminChoices'] as $id_admin) {
                //$spot = $this->getRepo()->find($id);
                $admin = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($id_admin);
                $entity->addAdmin($admin);
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('business_settings_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkBusinessSettings:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkBusiness entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkBusiness entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('business_admin'));
    }

    /**
     * Creates a form to delete a SkBusiness entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('business_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
