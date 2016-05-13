<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Ajax controller.
 *
 */
class AjaxController extends Controller {

    public function indexAction() {
        return $this->render('SkaphandrusAppBundle:Ajax:index.html.twig');
    }

    public function criteriasForSpeciesAction(Request $request) {
        $criterias = array();

        if ($request->query->get('slug')):
            $slug = $request->query->get('slug');
        endif;

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findBySlug($slug);

        //ir buscar a lista de id de criterios da especie
        $criterias_ids = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkIdentificationCriteria")->getCriteriasFromSpecies($species->getId());

        //ir buscar os criterios e todos os caracteres do criterio
        foreach ($criterias_ids as $key => $criteria) {
            $criterias[] = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->findCriteriaJoinAllCharacters($criteria);
        }

        foreach ($criterias as $key => $criteria) :
            foreach ($criteria->getCharacters() as $key => $character):
                $isFromSpecies = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->isCharacterFromSpecies($species->getId(), $character->getId());
                $character->setIsFromSpecies($isFromSpecies);
            endforeach;
        endforeach;

        return $this->render('SkaphandrusAppBundle:Ajax:criteriasForSpecies.html.twig', array(
                    "criterias" => $criterias,
        ));
    }

    /////// See All start \\\\\\\\

    public function spotSeeAllAction(Request $request) {

        $locale = $this->get('request')->getLocale();

        if ($request->query->get('location_id')):
            $location_id = $request->query->get('location_id');
            $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findSpotsInLocation($location_id, $locale);
        elseif ($request->query->get('user_id')):
            $user_id = $request->query->get('user_id');
            $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findSpotsInUser($user_id);
        elseif ($request->query->get('business_id')):
            $business_id = $request->query->get('business_id');
            $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findSpotsInBusiness($business_id);
        endif;

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
        elseif ($request->query->get('user_id')):
            $user_id = $request->query->get('user_id');
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesInUser($user_id);
        elseif ($request->query->get('business_id')):
            $business_id = $request->query->get('business_id');
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesInBusiness($business_id);
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesSeeAll.html.twig', array(
                    'species' => $species,
        ));
    }

    public function validationsSeeAllAction(Request $request) {

        $user_id = $request->query->get('user_id');

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findValidatedSpeciesInUser($user_id);

        return $this->render('SkaphandrusAppBundle:Ajax:speciesSeeAll.html.twig', array(
                    'species' => $species,
        ));
    }

    public function suggestionsSeeAllAction(Request $request) {

        $user_id = $request->query->get('user_id');

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSuggestedSpeciesInUser($user_id);

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
        elseif ($request->query->get('business_id')):
            $business_id = $request->query->get('business_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInBusiness($business_id);
        elseif ($request->query->get('taxon_name')):
            $taxon_name = $request->query->get('taxon_name');
            $taxon_id = $request->query->get('taxon_id');
            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findUsersInTaxon(null, $taxon_name, $taxon_id);
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersSeeAll.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    public function businessSeeAllAction(Request $request) {

        $param = $request->query->get('business');

        if ($param == "diveCenters"):
            $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAllDiveCenters();
            return $this->render('SkaphandrusAppBundle:Ajax:diveCentersSeeAll.html.twig', array(
                        'diveCenters' => $diveCenters,
            ));
        elseif ($param == "liveaboards"):
            $liveaboards = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAllLiveaboards();
            return $this->render('SkaphandrusAppBundle:Ajax:liveaboardsSeeAll.html.twig', array(
                        'liveaboards' => $liveaboards,
            ));
        elseif ($param == "accommodations"):
            $accommodations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAllAccommodations();
            return $this->render('SkaphandrusAppBundle:Ajax:accommodationsSeeAll.html.twig', array(
                        'accommodations' => $accommodations,
            ));
        endif;
    }

    public function countriesSeeAllAction() {

        $countriesArr = array();

        $countries = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->findAllCountriesDestinations();

        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countSpotsForDestinations();
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countPhotosForDestinations();
        $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countDiveCentersForDestinations();

        foreach ($countries as $country_id) {

            $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                    ->find($country_id['country']);

            if (isset($spots[$country->getId()])) {
                $country->setSpotsCount($spots[$country->getId()]);
            }
            if (isset($photos[$country->getId()])) {
                $country->setPhotosCount($photos[$country->getId()]);
            }
            if (isset($diveCenters[$country->getId()])) {
                $country->setDiveCentersCount($diveCenters[$country->getId()]);
            }

            $countriesArr[] = $country;
        }

        return $this->render('SkaphandrusAppBundle:Ajax:countriesSeeAll.html.twig', array(
                    'countries' => $countriesArr,
        ));
    }

    /////// See All end \\\\\\\\
    //
    //
    /////// Show More start \\\\\\\\

    public function spotShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $class = 'box_spacer';
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
            $class = 'box_spacer_right';
            $user_id = $request->query->get('user_id');
            $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpotsUser($locale, $user_id, $limit, $offset);
            foreach ($spots as $spot):
                $spot->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosSpotAndUser($spot->getId(), $user_id));
            endforeach;
        elseif ($request->query->get('business_id')) :
            $class = 'box_spacer_right';
            $business_id = $request->query->get('business_id');
            $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getMoreSpotsBusiness($locale, $business_id, $limit, $offset);
            foreach ($spots as $spot):
                $spot->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosBusiness($spot->getId(), $business_id));
            endforeach;
        endif;


        return $this->render('SkaphandrusAppBundle:Ajax:spotPartial.html.twig', array(
                    'spots' => $spots, 'class' => $class
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
        $class = 'box_spacer';
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
            $class = 'box_spacer_right';
            $user_id = $request->query->get('user_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesUser($user_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosUser($s->getId(), $user_id));
            endforeach;
        elseif ($request->query->get('business_id')):
            $class = 'box_spacer_right';
            $business_id = $request->query->get('business_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesBusiness($business_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findPhotosBusiness($s->getId(), $business_id));
            endforeach;

        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species, 'class' => $class
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
                    'species' => $species, 'class' => 'box_spacer_right'
        ));
    }

    public function suggestionsShowMoreAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        if ($request->query->get('user_id')):
            $user_id = $request->query->get('user_id');
            $species = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->getMoreSpeciesSuggestionsUser($user_id, $limit, $offset);
            foreach ($species as $s):
                $s->setPhotos($em->getRepository('SkaphandrusAppBundle:SkSpecies')->findSuggestionsPhotosUser($s->getId(), $user_id));
            endforeach;


        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:speciesPartial.html.twig', array(
                    'species' => $species, 'class' => 'box_spacer_right'
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
        elseif ($request->query->get('business_id')):
            $business_id = $request->query->get('business_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersBusiness($business_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosBusiness($p->getId(), $business_id));
            endforeach;
        elseif ($request->query->get('taxon_name')):
            $taxon_name = $request->query->get('taxon_name');
            $taxon_id = $request->query->get('taxon_id');
            $photographers = $em->getRepository('SkaphandrusAppBundle:FosUser')->getMorePhotographersTaxon($taxon_name, $taxon_id, $limit, $offset);
            foreach ($photographers as $p):
                $p->setPhotos($em->getRepository('SkaphandrusAppBundle:FosUser')->findPhotosTaxon($p->getId(), $taxon_id, $taxon_name));
            endforeach;
        endif;

        return $this->render('SkaphandrusAppBundle:Ajax:photographersPartial.html.twig', array(
                    'photographers' => $photographers,
        ));
    }

    public function businessShowMoreAction(Request $request) {

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $param = $request->query->get('business');

        if ($param == "diveCenters"):
            $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findDiveCentersPartial($limit, $offset);
            return $this->render('SkaphandrusAppBundle:Ajax:diveCentersPartial.html.twig', array(
                        'diveCenters' => $diveCenters,
            ));
        elseif ($param == "liveaboards"):
            $liveaboards = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findLiveaboardsPartial($limit, $offset);
            return $this->render('SkaphandrusAppBundle:Ajax:liveaboardsPartial.html.twig', array(
                        'liveaboards' => $liveaboards,
            ));
        elseif ($param == "accommodations"):
            $accommodations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAccommodationsPartial($limit, $offset);
            return $this->render('SkaphandrusAppBundle:Ajax:accommodationsPartial.html.twig', array(
                        'accommodations' => $accommodations,
            ));
        endif;
    }

    public function countriesShowMoreAction(Request $request) {
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $countriesArr = array();

        $countries = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->findPartialCountriesDestinations($limit, $offset);
        $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->countDiveCentersForDestinations();
        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->countSpotsForDestinations();
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->countPhotosForDestinations();

        foreach ($countries as $country_id) {
            $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                    ->find($country_id['country']);
            if (isset($spots[$country->getId()])) {
                $country->setSpotsCount($spots[$country->getId()]);
            }
            if (isset($photos[$country->getId()])) {
                $country->setPhotosCount($photos[$country->getId()]);
            }
            if (isset($diveCenters[$country->getId()])) {
                $country->setDiveCentersCount($diveCenters[$country->getId()]);
            }

            $countriesArr[] = $country;
        }

        return $this->render('SkaphandrusAppBundle:Ajax:countriesPartial.html.twig', array(
                    'countries' => $countriesArr,
        ));
    }

    /////// Show More end \\\\\\\\

    public function formAction(Request $request) {

        $locale = $this->get('request')->getLocale();

        $country_name = $request->query->get('country');
        if (!$country_name):
            $country_name = $request->request->get('country');
        endif;

        $location_name = $request->query->get('location');
        if (!$location_name):
            $location_name = $request->request->get('location');
        endif;

        $spot_name = $request->query->get('spot');
        if (!$spot_name):
            $spot_name = $request->request->get('spot');
        endif;

        $scientific_name = $request->query->get('scientific_name');
        if (!$scientific_name):
            $scientific_name = $request->request->get('scientific_name');
        endif;

        $common_name = $request->query->get('common_name');
        if (!$common_name):
            $common_name = $request->request->get('common_name');
        endif;

        $result = null;

        dump($request->request);
        
//        if ($request->request):
//            $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
//            $qb->select('s')->from('SkaphandrusAppBundle:SkSpot', 's');
//            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
//            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
//            $qb->join('r.country', 'c', 'WITH', 'r.country = c.id');
//        endif;

        //spots, locations and countries
        if ($spot_name) {
            $qb->join('s.translations', 'st');
            $qb->andWhere('st.name LIKE ?1');
            $qb->setParameter(1, "%" . $spot_name . "%");
        }

        if ($location_name) {
            $qb->join('l.translations', 'lt');
            $qb->andWhere('lt.name LIKE ?2');
            $qb->setParameter(2, "%" . $location_name . "%");
        }

        if ($country_name) {
            $country_ids = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->findCountryDestinations($country_name, $locale);
            $qb->andWhere('c.id IN( ?3 )');
            $qb->setParameter(3, implode(', ', $country_ids));
        }

        //species scientific name
        if ($scientific_name) {
            $qb->join('s.photos', 'p', 'WITH', 'p.spot = s.id');
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.scientific_names', 'sn', 'WITH', 'sn.species = sp.id');
            $qb->andWhere('sn.name LIKE ?4');
            $qb->setParameter(4, "%" . $scientific_name . "%");
        }

        //species common name
        if ($common_name) {
            $qb->join('s.photos', 'p', 'WITH', 'p.spot = s.id');
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.species_vernaculars', 'sv', 'WITH', 'sv.species = sp.id');
            $qb->join('sv.vernacular', 'v', 'WITH', 'sv.vernacular = v.id');
            $qb->andWhere('v.name LIKE ?5');
            $qb->setParameter(5, "%" . $common_name . "%");
        }

//        if ($request->request):
//            $query = $qb->getQuery();
//            $result = $query->getResult();
//        endif;

        //mapa em branco
        $map = $this->get('ivory_google_map.map');
        $map->setAsync(true);
        $map->setCenter(40, 0, true);
        $map->setStylesheetOptions(array(
            'width' => 'auto',
            'height' => '450px',
        ));
        $latitude = 0;
        $longitude = 0;
        $centerLatitude = 0;
        $centerLongitude = 0;

        if ($result) {

            // Get markers from spots for the map
            $markers = array();

            foreach ($result as $s) {

                //dump($s->getCoordinate());
                if ($s->getCoordinate()) {

                    try {
                        $marker = new Marker();

                        //remove white spaces
                        $latitude = preg_replace('/\s+/', '', explode(",", $s->getCoordinate())[0]);
                        $longitude = preg_replace('/\s+/', '', explode(",", $s->getCoordinate())[1]);

                        $infowindow = new InfoWindow();
                        $spot_url = $this->generateUrl('spot', array(
                            'slug' => $s->getName(),
                            'location' => $s->getLocation(),
                            'country' => $s->getLocation()->getRegion()->getCountry()
                        ));

                        $contentString = "<a href=" . $spot_url . ">" . $s->getName() . "</a>";

                        $infowindow->setContent($contentString);
                        $infowindow->setAutoClose(TRUE);

                        // Marker options
                        $marker->setInfoWindow($infowindow);
                        $marker->setPrefixJavascriptVariable('marker_');


                        $marker->setPosition($latitude, $longitude, true);

                        $marker->setAnimation(Animation::DROP);
                        $marker->setOption('clickable', true);
                        $marker->setOption('flat', true);
                        $marker->setOptions(array(
                            'clickable' => true,
                            'flat' => true,
                        ));

                        $markers[] = $marker;
                    } catch (\Ivory\GoogleMap\Exception\OverlayException $ex) {
                        //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                    } catch (\Symfony\Component\Routing\Exception\InvalidParameterException $ex) {
                        //erro da constraução do url (/etc
                    }
                }
            }

            // Create the map
            $centerLatitude = $latitude;
            $centerLongitude = $longitude;

            $map = new Map();
            $map->setPrefixJavascriptVariable('map_');
            $map->setHtmlContainerId('map_canvas');
            $map->setAsync(true);
            $map->setCenter($centerLatitude, $centerLongitude, true);
            $map->setMapOption('zoom', 3);
            $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
            $map->setMapOption('disableDefaultUI', true);
            $map->setMapOption('disableDoubleClickZoom', true);
            $map->setMapOptions(array(
                'disableDefaultUI' => true,
                'disableDoubleClickZoom' => true,
            ));
            $map->setStylesheetOption('width', 'auto');
            $map->setStylesheetOption('height', '450px');
            $map->setStylesheetOptions(array(
                'width' => 'auto',
                'height' => '450px',
            ));
            $map->setLanguage('en');

            // Add the spots to the map
            foreach ($markers as $marker) {
                $map->addMarker($marker);
            }
        }

        $map_html = $this->render('SkaphandrusAppBundle:Ajax:destinationsPartial.html.twig', array(
                    'map' => $map
                ))->getContent();

        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'map' => $map_html, 'results' => count($map->getMarkers())
        ));
    }

}
