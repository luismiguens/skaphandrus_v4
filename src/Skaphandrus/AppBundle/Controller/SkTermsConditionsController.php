<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkTermsConditions;

/**
 * SkTermsConditions controller.
 *
 */
class SkTermsConditionsController extends Controller {

    /**
     * Lists all SkTermsConditions entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkTermsConditions')->findAll();

        return $this->render('SkaphandrusAppBundle:SkTermsConditions:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

}
