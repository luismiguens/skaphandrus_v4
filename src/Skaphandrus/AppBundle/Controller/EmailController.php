<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * SkBooking controller.
 *
 */
class SkBookingController extends Controller {

    
    public function sendTestEmailBooking($email) {
    
        
        //enviar apenas para o email passado no url do browser
        //apresentar na view para onde enviou
    }
    
    
    public function sendAllEmailsBooking($subject = "New Booking Submited") {

        
        
        //criar um ciclo for para todos os utilizadores que tenham  sk_settings.email_update=1
        
        
        
        
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

        //apresentar na view para onde enviou
        
        
        $this->get('mailer')->send($message);
        
        
        try{
            
            
            
            
        } catch (\Exception $ex) {

            echo $ex->getTraceAsString();
            
            
        }
        
        
        
    }


}
