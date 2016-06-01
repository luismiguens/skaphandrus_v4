<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller {

    public function expertsAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->countSpeciesValidatedForUsers();

        return $this->render('SkaphandrusAppBundle:About:experts.html.twig', array(
                    'user' => $user
        ));
    }

    public function pointsAction() {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->get('request')->getLocale();

        $points = $em->getRepository('SkaphandrusAppBundle:SkPoints')->findAllPoints($locale);
        $arr = $em->getRepository('SkaphandrusAppBundle:SkPoints')->getValueOfPoints();

        return $this->render('SkaphandrusAppBundle:About:points.html.twig', array(
                    'points' => $points,
                    'arr' => $arr
        ));
    }

    public function contestProgramsAction() {

        return $this->render('SkaphandrusAppBundle:About:contestPrograms.html.twig', array());
    }

    public function businessProgramsAction() {

        return $this->render('SkaphandrusAppBundle:About:businessPrograms.html.twig', array());
    }

    public function termsAction() {
        $em = $this->getDoctrine()->getManager();

        $terms = $em->createQuery("SELECT t FROM SkaphandrusAppBundle:SkTermsConditions t ORDER by t.id DESC")->setMaxResults(1)->getOneOrNullResult();

        return $this->render('SkaphandrusAppBundle:About:terms.html.twig', array(
                    'terms' => $terms,
        ));
    }

}
