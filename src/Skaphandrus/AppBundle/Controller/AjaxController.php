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

    /////// See All start \\\\\\\\

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
        elseif ($request->query->get('spot_id')):
            $spot_id = $request->query->get('spot_id');
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesInSpot($spot_id);
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
        elseif ($request->query->get('spot_id')):
            $spot_id = $request->query->get('spot_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInSpot($spot_id);
        elseif ($request->query->get('species_id')):
            $species_id = $request->query->get('species_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInSpecies($species_id);
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersSeeAll.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    /////// See All end \\\\\\\\
    //
    //
    /////// Show More start \\\\\\\\

    public function spotShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $locale = $this->get('request')->getLocale();
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');
        
        if ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpotsLocation($locale, $location_id, $limit, $offset);
            foreach ($spots as $spot):
                $spot->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosLocation($spot->getId(), $location_id));
            endforeach;
        elseif ($request->query->get('user_id')) :
            $user_id = $request->query->get('user_id');
            $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpotsUser($locale, $user_id, $limit, $offset);
            foreach ($spots as $spot):
                $spot->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosSpotAndUser($spot->getId(), $user_id));
            endforeach;
        endif;


        return $this->render('SkaphandrusAppBundle:Ajax:spotPartial.html.twig', array(
                    'spots' => $spots,
        ));
    }

    public function locationShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

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

    public function speciesShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        if ($request->query->get('country_id')):
            $country_id = $request->query->get('country_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesCountry($country_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosCountry($s->getId(), $country_id));
            endforeach;
        elseif ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesLocation($location_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosLocation($s->getId(), $location_id));
            endforeach;
        elseif ($request->query->get('spot_id')):
            $spot_id = $request->query->get('spot_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesSpot($spot_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosSpot($s->getId(), $spot_id));
            endforeach;
        elseif ($request->query->get('user_id')):
            $user_id = $request->query->get('user_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesUser($user_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosUser($s->getId(), $user_id));
            endforeach;
            
            
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species,
        ));
    }
    
    
        public function validationsShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        if ($request->query->get('user_id')):
            $user_id = $request->query->get('user_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesValidationsUser($user_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findValidationsPhotosUser($s->getId(), $user_id));
            endforeach;
            
            
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species,
        ));
    }
    

    public function photographersShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        if ($request->query->get('country_id')):
            $country_id = $request->query->get('country_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersCountry($country_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosCountry($p->getId(), $country_id));
            endforeach;
        elseif ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersLocation($location_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosLocation($p->getId(), $location_id));
            endforeach;
        elseif ($request->query->get('spot_id')):
            $spot_id = $request->query->get('spot_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersSpot($spot_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosSpot($p->getId(), $spot_id));
            endforeach;
        elseif ($request->query->get('species_id')):
            $species_id = $request->query->get('species_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersSpecies($species_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosSpecies($p->getId(), $species_id));
            endforeach;
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersPartial.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    /////// Show More end \\\\\\\\
}
