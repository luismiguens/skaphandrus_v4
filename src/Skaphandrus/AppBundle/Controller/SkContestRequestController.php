<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkContestRequest;
use Skaphandrus\AppBundle\Form\SkContestRequestType;

/**
 * SkContestRequest controller.
 *
 */
class SkContestRequestController extends Controller {
//    /**
//     * Lists all SkContestRequest entities.
//     *
//     */
//    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkContestRequest')->findAll();
//
//        return $this->render('SkaphandrusAppBundle:SkContestRequest:index.html.twig', array(
//                    'entities' => $entities,
//        ));
//    }

    /**
     * Creates a new SkContestRequest entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkContestRequest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $message = \Swift_Message::newInstance()
                    ->setSubject("Create Photo Contest")
                    ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
                    ->setTo('luis.t.miguens@gmail.com')
                    ->setBody($this->renderView('SkaphandrusAppBundle:SkContestRequest:content_email.html.twig', array(
                        'user' => $entity->getName(),
                        'email' => $entity->getEmail(),
                        'phone' => $entity->getPhone(),
                        'description' => $entity->getDescription(),
                    )), 'text/html');

            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.request_saved');
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('SkaphandrusAppBundle:SkContestRequest:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkContestRequest entity.
     *
     * @param SkContestRequest $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkContestRequest $entity) {
        $form = $this->createForm(new SkContestRequestType(), $entity, array(
            'action' => $this->generateUrl('contest_request_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkContestRequest entity.
     *
     */
    public function newAction() {
        $entity = new SkContestRequest();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkContestRequest:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

//    /**
//     * Finds and displays a SkContestRequest entity.
//     *
//     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkContestRequest')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkContestRequest entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkContestRequest:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing SkContestRequest entity.
//     *
//     */
//    public function editAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkContestRequest')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkContestRequest entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkContestRequest:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to edit a SkContestRequest entity.
//     *
//     * @param SkContestRequest $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createEditForm(SkContestRequest $entity) {
//        $form = $this->createForm(new SkContestRequestType(), $entity, array(
//            'action' => $this->generateUrl('contest_request_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }
//
//    /**
//     * Edits an existing SkContestRequest entity.
//     *
//     */
//    public function updateAction(Request $request, $id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkContestRequest')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkContestRequest entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('contest_request_edit', array('id' => $id)));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkContestRequest:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Deletes a SkContestRequest entity.
//     *
//     */
//    public function deleteAction(Request $request, $id) {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('SkaphandrusAppBundle:SkContestRequest')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find SkContestRequest entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('contest_request'));
//    }
//
//    /**
//     * Creates a form to delete a SkContestRequest entity by id.
//     *
//     * @param mixed $id The entity id
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm($id) {
//        return $this->createFormBuilder()
//                        ->setAction($this->generateUrl('contest_request_delete', array('id' => $id)))
//                        ->setMethod('DELETE')
//                        ->add('submit', 'submit', array('label' => 'Delete'))
//                        ->getForm()
//        ;
//    }
}
