<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ajax controller.
 *
 */
class AjaxController extends Controller {

    public function indexAction() {

        return $this->render('SkaphandrusAppBundle:Ajax:index.html.twig');
    }

    public function spotAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        
        $locale = $this->get('request')->getLocale();
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpots($limit, $offset, $locale);

        return $this->render('SkaphandrusAppBundle:Ajax:spot.html.twig', array(
                    'spots' => $spots,
        ));
    }

}
