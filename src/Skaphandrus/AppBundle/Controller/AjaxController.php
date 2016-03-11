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

    public function spotSeeAllAction(Request $request) {

        $locale = $this->get('request')->getLocale();
        $location_id = $request->query->get('location_id');

        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findSpotsInLocation($location_id, $locale);

        return $this->render('SkaphandrusAppBundle:Ajax:spotSeeAll.html.twig', array(
                    'spots' => $spots,
        ));
    }

    public function locationSeeAllAction(Request $request) {

        $locale = $this->get('request')->getLocale();
        $country_id = $request->query->get('country_id');

        $locations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')->findLocationsInCountry($country_id, $locale);

        return $this->render('SkaphandrusAppBundle:Ajax:locationSeeAll.html.twig', array(
                    'locations' => $locations,
        ));
    }

    public function speciesSeeAllAction(Request $request) {

        if ($request->query->get('country_id')):
            $country_id = $request->query->get('country_id');
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesInCountry($country_id);
        elseif ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesInLocation($location_id);
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesSeeAll.html.twig', array(
                    'species' => $species,
        ));
    }

    public function photographersSeeAllAction(Request $request) {

        if ($request->query->get('country_id')):
            $country_id = $request->query->get('country_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInCountry($country_id);
        elseif ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInLocation($location_id);
        endif;
        
        return $this->render('SkaphandrusAppBundle:Ajax:photographersSeeAll.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    public function speciesSpotAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $spot_id = $request->query->get('spot_id');

        $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesSpot($spot_id, $limit, $offset);

        foreach ($species as $s):
            $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosSpot($s->getId(), $spot_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species,
        ));
    }

    public function photographersSpotAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $spot_id = $request->query->get('spot_id');

        $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersSpot($spot_id, $limit, $offset);

        foreach ($photographers as $p):
            $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosSpot($p->getId(), $spot_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersPartial.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    public function spotLocationAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $locale = $this->get('request')->getLocale();
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $location_id = $request->query->get('location_id');

        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpotsLocation($locale, $location_id, $limit, $offset);

        foreach ($spots as $spot):
            $spot->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosLocation($spot->getId(), $location_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:spotPartial.html.twig', array(
                    'spots' => $spots,
        ));
    }

    public function speciesLocationAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $location_id = $request->query->get('location_id');

        $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesLocation($location_id, $limit, $offset);

        foreach ($species as $s):
            $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosLocation($s->getId(), $location_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species,
        ));
    }

    public function photographersLocationAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $location_id = $request->query->get('location_id');

        $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersLocation($location_id, $limit, $offset);

        foreach ($photographers as $p):
            $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosLocation($p->getId(), $location_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersPartial.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    public function locationCountryAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

//        $locale = $this->get('request')->getLocale();
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $country_id = $request->query->get('country_id');

        $locations = $em->getRepository('SkaphandrusAppBundle:SkLocation')->getMoreLocationCountry($country_id, $limit, $offset);

        foreach ($locations as $location):
            $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findOneBy(array('location' => $location->getId()));
            $spots->setPhotos($em->getRepository('SkaphandrusAppBundle:SkLocation')->findPhotosCountry($location->getId(), $country_id));
            $location->setSpots($spots);
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:locationPartial.html.twig', array(
                    'locations' => $locations,
        ));
    }

    public function speciesCountryAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $country_id = $request->query->get('country_id');

        $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesCountry($country_id, $limit, $offset);

        foreach ($species as $s):
            $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosCountry($s->getId(), $country_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species,
        ));
    }

    public function photographersCountryAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        $country_id = $request->query->get('country_id');

        $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersCountry($country_id, $limit, $offset);

        foreach ($photographers as $p):
            $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosCountry($p->getId(), $country_id));
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersPartial.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

}
