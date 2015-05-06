<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;

class ContestController extends Controller {
    
    public function landingAction() {

        $contests = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findBy(array(), array('beginAt' => 'DESC'));

        return $this->render('SkaphandrusAppBundle:Contest:landing.html.twig', array(
            'contests' => $contests,
        ));
    }

    public function contestAction($slug) {
        $name = str_replace('-', ' ', $slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findOneByName($name);


        return $this->render('SkaphandrusAppBundle:Contest:contest.html.twig',array(
            'contest' => $contest,
        ));
    }
}
