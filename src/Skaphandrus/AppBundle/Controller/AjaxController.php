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

//        if ($limit == null and $offset == null) {
//            $limit = 10;
//            $offset = 0;
//        }

        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getTenSpots($limit, $offset, $locale);

        return $this->render('SkaphandrusAppBundle:Ajax:spot.html.twig', array(
                    'spots' => $spots,
        ));
    }

}
