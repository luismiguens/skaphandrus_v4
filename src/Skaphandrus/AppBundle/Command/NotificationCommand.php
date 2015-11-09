<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationCommand
 *
 * @author luis
 */

namespace Skaphandrus\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NotificationCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('skaphandrus:notification')
                ->setDescription('1:hourly, 2:daily, 3:weekly')
                ->addArgument(
                        'time', InputArgument::OPTIONAL, 'Time Interval?'
                )
//                ->addOption(
//                        'yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters'
//                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $container = $this->getContainer();
        $mailer = $container->get('mailer');

        $em = $container->get('doctrine')->getManager();
        $time = $input->getArgument('time');
        //$users = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findUsersToNotify($time);

        $users = array(5, 791);


        foreach ($users as $key => $user_id) {

            $fos_user = $em->getRepository('SkaphandrusAppBundle:FosUser')->findOneById($user_id);

            //$fos_user = new \Skaphandrus\AppBundle\Entity\FosUser();
            $subject = $fos_user->getName() . ", here's what's happening on Skaphandrus!";

            $notifications = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findByUserTo($fos_user, array('id'=>'desc'));

            $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom('support@skaphandrus.com')
                    ->setTo($fos_user->getEmail())
                    ->setBcc('luis.miguens@skaphandrus.com')
                    ->setBody(
                    $this->getContainer()->get('templating')->render(
                            'SkaphandrusAppBundle:FOSUserEmail:notification.html.twig', array(
                        'fos_user' => $fos_user,
                        'notifications' => $notifications)
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

            $mailer->send($message);
            $output->writeln("mail sent to " . $fos_user->getName());
//            
//            
//            
//            
//            $output->writeln("mail sent to " . $fos_user->getName());
//            
//            
//             $output->writeln($this->getContainer()->get('templating')->render(
//                            'SkaphandrusAppBundle:FOSUserEmail:notification.html.twig', array(
//                        'fos_user' => $fos_user,
//                        'notifications' => $notifications)
//                    ));
            
            
        }



//$mailer = $container->get('mailer');
//$spool = $mailer->getTransport()->getSpool();
//$transport = $container->get('swiftmailer.transport.real');
//$spool->flushQueue($transport);
    }

}
