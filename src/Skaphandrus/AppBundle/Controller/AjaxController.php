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
        $location_id = $request->query->get('location_id');

        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpots($locale, $location_id, $limit, $offset);

        return $this->render('SkaphandrusAppBundle:Ajax:spot.html.twig', array(
                    'spots' => $spots,
        ));
    }

    public function speciesAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $location_id = $request->query->get('location_id');

        $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpecies($location_id, $limit, $offset);

        return $this->render('SkaphandrusAppBundle:Ajax:species.html.twig', array(
                    'species' => $species,
        ));
    }

    public function photographersAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $location_id = $request->query->get('location_id');

        $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographers($location_id, $limit, $offset);

        return $this->render('SkaphandrusAppBundle:Ajax:photographers.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

}
