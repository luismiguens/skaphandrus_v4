<?php

namespace Skaphandrus\AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Skaphandrus\AppBundle\Entity\SkBooking;
use Skaphandrus\AppBundle\Form\SkBookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * SkBooking controller.
 *
 */
class SkBookingController extends Controller {

    public function sendEmailBooking(SkBooking $booking, $subject = "new booking submited") {

        //subject = mensagem de novo booking ou actualização de booking

        $addresses = $booking->getBusiness()->getAdminsEmails();

        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
                ->setTo($booking->getBusiness()->getContact()->getEmail())
                ->setCc($addresses)
                ->setBcc('luis.miguens@skaphandrus.com')
                ->setBody(
                $this->renderView(
                        'SkaphandrusAppBundle:SkBooking:booking.html.twig', array(
                    'booking' => $booking)
                ), 'text/html'
                )
        /*
         * If you also want to include a plaintext version of the message
          ->addPart(
          $this->renderView(
          'Emails/registration.txt.twig',
          array('name' => $name)
          ),
          'text/plain'
          )
         */
        ;

        $this->get('mailer')->send($message);
    }

    /**
     * Lists all SkBooking entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $fos_user = $this->get('security.token_storage')->getToken()->getUser();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkBooking')->findBy(array('fosUser' => $fos_user));

        return $this->render('SkaphandrusAppBundle:SkBooking:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkBooking entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkBooking();
        $em = $this->getDoctrine()->getManager();

//        $business_id = $request->query->get('business_id');
//        if (!$business_id):
//            $business_id = $request->request->get('business_id');
//        endif;
//        $business_id = 1977;
//        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($business_id);

        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $entity->setFosUser($fos_user);
        //$entity->setBusiness($business);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


            //enviar email com indicação de nova reserva

            $subject = "new booking submited";

            $this->sendEmailBooking($entity, $subject);


            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('booking_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkBooking:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkBooking entity.
     *
     * @param SkBooking $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(SkBooking $entity) {
        $form = $this->createForm(new SkBookingType(), $entity, array(
            'action' => $this->generateUrl('booking_admin_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkBooking entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entity = new SkBooking();

        //$business_id = $request->query->get('business_id');

        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $entity->setFosUser($fos_user);
        $entity->setEmail($fos_user->getEmail());
        $entity->setPhoneNumber($fos_user->getContact()->getMobilePhone());

        $business_id = $request->query->get('business_id');
        if (!$business_id):
            $business_id = $request->request->get('business_id');
        endif;

//        $business_id = 1977;

        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($business_id);
        $entity->setBusiness($business);

        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkBooking:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkBooking entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBooking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkBooking:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkBooking entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBooking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkBooking:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkBooking entity.
     *
     * @param SkBooking $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(SkBooking $entity) {
        $form = $this->createForm(new SkBookingType(), $entity, array(
            'action' => $this->generateUrl('booking_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkBooking entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBooking entity.');
        }

        //$entity = new SkBooking();
        //http://symfony.com/doc/current/cookbook/form/form_collections.html
        //For deleting dives 
        $originalDives = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getBookingDive() as $dive) {
            $originalDives->add($dive);
        }

        //http://symfony.com/doc/current/cookbook/form/form_collections.html
        //For deleting dives 
        $originalOtherActivity = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getBookingOtherActivity() as $other) {
            $originalOtherActivity->add($other);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            // remove the relationship between the Tag and the Task
            foreach ($originalDives as $dive) {
                if (false === $entity->getBookingDive()->contains($dive)) {
                    // remove the Task from the Tag
                    $dive->getBooking()->removeBookingDive($dive);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $course->setBusiness(null);
                    // $em->persist($course);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($dive);
                }
            }

            // remove the relationship between the Tag and the Task
            foreach ($originalOtherActivity as $other) {
                if (false === $entity->getBookingOtherActivity()->contains($other)) {
                    // remove the Task from the Tag
                    $other->getBooking()->removeBookingOtherActivity($other);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $course->setBusiness(null);
                    // $em->persist($course);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($other);
                }
            }

            $em->persist($entity);
            $em->flush();

            //enviar email com indicação de actualização da reserva

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

            return $this->redirect($this->generateUrl('booking_admin_show', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkBooking:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkBooking entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkBooking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkBooking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('booking_admin'));
    }

    /**
     * Creates a form to delete a SkBooking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('booking_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
