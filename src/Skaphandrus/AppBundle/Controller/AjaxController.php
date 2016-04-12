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
                ->countSpotsArray();
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countPhotosArray();
        $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countDiveCentersArray();

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
        $location_name = $request->query->get('location');
        $spot_name = $request->query->get('spot');
        $species_name = $request->query->get('species');

//        $map = $this->get('ivory_google_map.map');
        $map = null;
        $latitude = 0;
        $longitude = 0;
        $centerLatitude = 0;
        $centerLongitude = 0;

        //Mapa para os paises
        if ($country_name) {
            $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->findBySlug($country_name, $locale);
            $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')->getSpots($country->getId());

            if (count($spot) > 0) {

                // Get markers from spots for the map
                $markers = array();

                foreach ($spot as $s) {

                    //dump($s->getCoordinate());
                    if ($s->getCoordinate()) {
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
                    }
                }

                // Create the map
                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
                $map->setCenter($centerLatitude, $centerLongitude, true);
                $map->setMapOption('zoom', 4);
                $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $map->setMapOption('disableDefaultUI', true);
                $map->setMapOption('disableDoubleClickZoom', true);
                $map->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
                $map->setStylesheetOption('width', 'auto');
                $map->setStylesheetOption('height', '300px');
                $map->setStylesheetOptions(array(
                    'width' => 'auto',
                    'height' => '300px',
                ));
                $map->setLanguage('en');

                // Add the spots to the map
                foreach ($markers as $marker) {
                    $map->addMarker($marker);
                }
            }
        }

        //Mapa para as locations
        if ($location_name) {
            $location = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')->findLocationDestinations($location_name, $locale);

            if (count($location->getSpots()) > 0) {

                // Get markers from spots for the map
                $markers = array();

                foreach ($location->getSpots() as $s) {

                    //dump($s->getCoordinate());
                    if ($s->getCoordinate()) {
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
                    }
                }

                // Create the map
                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
                $map->setCenter($centerLatitude, $centerLongitude, true);
                $map->setMapOption('zoom', 10);
                $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $map->setMapOption('disableDefaultUI', true);
                $map->setMapOption('disableDoubleClickZoom', true);
                $map->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
                $map->setStylesheetOption('width', 'auto');
                $map->setStylesheetOption('height', '300px');
                $map->setStylesheetOptions(array(
                    'width' => 'auto',
                    'height' => '300px',
                ));
                $map->setLanguage('en');

                // Add the spots to the map
                foreach ($markers as $marker) {
                    $map->addMarker($marker);
                }
            }
        }

        //Mapa para o Spot
        if ($spot_name) {
            $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findSpotDestinations($spot_name);

            if ($spot) {

                // Get markers from spots for the map
                $markers = array();

                //dump($s->getCoordinate());
                if ($spot->getCoordinate()) {
                    $marker = new Marker();

                    //remove white spaces
                    $latitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[0]);
                    $longitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[1]);

                    $infowindow = new InfoWindow();
                    $spot_url = $this->generateUrl('spot', array(
                        'slug' => $spot->getName(),
                        'location' => $spot->getLocation(),
                        'country' => $spot->getLocation()->getRegion()->getCountry()
                    ));

                    $contentString = "<a href=" . $spot_url . ">" . $spot->getName() . "</a>";

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
                }

                // Create the map
                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
                $map->setCenter($centerLatitude, $centerLongitude, true);
                $map->setMapOption('zoom', 10);
                $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $map->setMapOption('disableDefaultUI', true);
                $map->setMapOption('disableDoubleClickZoom', true);
                $map->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
                $map->setStylesheetOption('width', 'auto');
                $map->setStylesheetOption('height', '300px');
                $map->setStylesheetOptions(array(
                    'width' => 'auto',
                    'height' => '300px',
                ));
                $map->setLanguage('en');

                // Add the spot to the map
                $map->addMarker($marker);
            }
        }

        //Mapa para o Species
        if ($species_name) {
            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findSpeciesDestinations($species_name);
            $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->getSpots($species->getId());

            if (count($spot) > 0) {

                // Get markers from spots for the map
                $markers = array();

                foreach ($spot as $s) {

                    //dump($s->getCoordinate());
                    if ($s->getCoordinate()) {
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
                    }
                }

                // Create the map
                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
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
                $map->setStylesheetOption('height', '300px');
                $map->setStylesheetOptions(array(
                    'width' => 'auto',
                    'height' => '300px',
                ));
                $map->setLanguage('en');

                // Add the spots to the map
                foreach ($markers as $marker) {
                    $map->addMarker($marker);
                }
            }
        }

        return $this->render('SkaphandrusAppBundle:Ajax:destinationsPartial.html.twig', array(
                    'map' => $map,
        ));
    }

}
