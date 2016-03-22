<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * SkBooking controller.
 *
 */
class EmailController extends Controller {

    public function sendTestEmailAction(Request $request) {

        //enviar apenas para o email passado no url do browser
        //apresentar na view para onde enviou
        $email = $request->query->get('email');

        $message = \Swift_Message::newInstance()
                ->setSubject("email-teste")
                ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
                ->setTo($email)
                ->setBcc('rubensardinha@hotmail.com')
                ->setBody($this->renderView('SkaphandrusAppBundle:Email:email.html.twig'), 'text/html');

        $this->get('mailer')->send($message);

        try {
            return $this->render('SkaphandrusAppBundle:Email:emailSend.html.twig', array(
                        'email' => $email,
            ));
        } catch (\Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function sendAllEmailsAction($subject = "NewsLetter") {

        //criar um ciclo for para todos os utilizadores que tenham  sk_settings.email_update=1
        $users = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->getUserToSendEmail();

        $addresses = array();

        foreach ($users as $user) {
            if ($user->getEmail()) {
                $addresses[] = $user->getEmail();
            }
        }

        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
                ->setTo($addresses)
                ->setBcc('luis.miguens@skaphandrus.com')
                ->setBody($this->renderView('SkaphandrusAppBundle:Email:email.html.twig'), 'text/html')
//                ->setBody($this->renderView('SkaphandrusAppBundle:Email:email.html.twig', array('email' => teste)), 'text/html')
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

        //apresentar na view para onde enviou
        $this->get('mailer')->send($message);


        try {
            return $this->render('SkaphandrusAppBundle:Email:emailSend.html.twig', array(
                        'addresses' => $addresses,
            ));
        } catch (\Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

//    public function sendAllEmailsAction($subject = "NewsLetter") {
//
//        //criar um ciclo for para todos os utilizadores que tenham  sk_settings.email_update=1
//        $users = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                ->getUserToSendEmail();
//
//        $addresses = array();
//
//        foreach ($users as $user) {
//            $addresses[] = $user->getEmail();
//        }
//
//        $message = \Swift_Message::newInstance()
//                ->setSubject($subject)
//                ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
//                ->setTo($addresses)
//                ->setBcc('luis.miguens@skaphandrus.com')
//                ->setBody($this->renderView('SkaphandrusAppBundle:Email:email.html.twig'), 'text/html')
////                ->setBody($this->renderView('SkaphandrusAppBundle:Email:email.html.twig', array('email' => teste)), 'text/html')
//        /*
//         * If you also want to include a plaintext version of the message
//          ->addPart(
//          $this->renderView(
//          'Emails/registration.txt.twig',
//          array('name' => $name)
//          ),
//          'text/plain'
//          )
//         */
//        ;
//
//        //apresentar na view para onde enviou
//        $this->get('mailer')->send($message);
//
//        try {
//            return $this->render('SkaphandrusAppBundle:Email:emailSend.html.twig', array(
//                        'addresses' => $addresses,
//            ));
//        } catch (\Exception $ex) {
//            echo $ex->getTraceAsString();
//        }
//    }
}
