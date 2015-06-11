<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IdentificationController extends Controller {

    public function modulesAction() {

        return $this->render('SkaphandrusAppBundle:Identification:modules.html.twig');
    }

    public function criteriasAction($slug) {

        $locale = $this->get('request')->getLocale();

        //module
        $module = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
                ->findBySlug($slug, $locale);

        return $this->render('SkaphandrusAppBundle:Identification:criterias.html.twig', array('module' => $module));
    }

}
