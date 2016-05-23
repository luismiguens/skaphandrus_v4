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
                ->setBody($this->renderView('SkaphandrusAppBundle:Email:content_email.html.twig'), 'text/html');

        $this->get('mailer')->send($message);

        return $this->render('SkaphandrusAppBundle:Email:sendEmail.html.twig', array(
                    'sendAddress' => $email,
        ));
    }

    public function sendAllEmailsAction(Request $request, $subject = "Skaphandrus - BIO Nudis 2016 Photo Contest") {

        //criar um ciclo for para todos os utilizadores que tenham  sk_settings.email_update=1
        //apresentar na view para onde enviou
        $param = $request->query->get('param');
        
        $addresses = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->getUserToSendEmail($param);

//        $addresses = array("rubensardinha1992@gmail.com", "macacim@hotmail.com", "test@", "rubensardinha@hotmail.com");
        $sendAddress = array();

        foreach ($addresses as $address) {

            if (filter_var($address->getEmail(), FILTER_VALIDATE_EMAIL)) {

                $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom('noreply-notification@skaphandrus.com', 'Skaphandrus')
                        ->setTo($address->getEmail())
                        ->setBcc('noreply@skaphandrus.com')
                        ->setBody($this->renderView('SkaphandrusAppBundle:Email:content_email.html.twig', array(
                            'user' => $address->getName()
                        )), 'text/html');

                $this->get('mailer')->send($message);
                $sendAddress[] = $address . " -> " . $address->getEmail();
            }
        }

        return $this->render('SkaphandrusAppBundle:Email:sendEmail.html.twig', array(
                    'sendAddress' => implode(', ', $sendAddress),
        ));
    }

//    public function sendAllEmailsAction($subject = "NewsLetter") {
//
//        //criar um ciclo for para todos os utilizadores que tenham  sk_settings.email_update=1
//        //apresentar na view para onde enviou
////        $users = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
////                ->getUserToSendEmailTest();
////        $addresses = array();
//
//        $addresses = array("rubensardinha@hotmail.com", "teste@gmail", "teste@", "teste@@gmail.com", "rubensardinha1992@gmail.com", "macacim@hotmail.com");
//
////        foreach ($users as $user) {
////            if ($user->getEmail()) {
////                $addresses[] = $user->getEmail();
////            }
////        }
//
//        $message = \Swift_Message::newInstance()
//                ->setSubject($subject)
//                ->setFrom('support-noreply@skaphandrus.com', 'Skaphandrus')
//                ->setTo($addresses)
//                ->setBcc('rubensardinha@hotmail.com')
//                ->setBody($this->renderView('SkaphandrusAppBundle:Email:content_email.html.twig'), 'text/html')
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
//        $this->get('mailer')->send($message);
//
//        try {
//            return $this->render('SkaphandrusAppBundle:Email:emailSend.html.twig', array(
//                        'email_string' => implode(',', $addresses),
//            ));
//        } catch (\Exception $ex) {
//            echo $ex->getTraceAsString();
//        }
//    }
}
