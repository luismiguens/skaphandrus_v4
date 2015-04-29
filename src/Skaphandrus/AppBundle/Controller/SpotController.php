<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;
use Cocur\Slugify\Slugify;

class SpotController extends Controller {

    public function spotAction($country, $location, $slug) {
        $name = str_replace('-', ' ', $slug);
        $locale = $this->get('request')->getLocale();
        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
            ->findOneBySlugJoinedToTranslation($name, $locale);
        
        if ($spot) {
            // Validate location from url
            $location_obj = $spot->getLocation();
            $location_translation = $location_obj->translate($locale);
            if ($location_translation->getName() != $location) {
                throw $this->createNotFoundException('There is no spot '. $name .' on location ' . $location . '.');
            }
            // Validate country from url
            $country_obj = $location_obj->getRegion()->getCountry();
            $country_name = Intl::getRegionBundle()->getCountryName($country_obj->getName());
            if ($country_name != $country) {
                throw $this->createNotFoundException('There is no spot '. $name .' on country ' . $country . '.');
            }

            return $this->render('SkaphandrusAppBundle:Spot:spot.html.twig', array(
                'spot' => $spot,
                'spot_translation' => $spot->translate($locale),
                'location' => $location_obj,
                'location_translation' => $location_translation,
                'country' => $country_obj,
                'country_name' => $country_name,
            ));
        }
        else {
            throw $this->createNotFoundException('The spot '. $name .' does not exist.');
        }
    }

    /*
     * Location page.
     */
    public function locationAction($country, $slug) {
        $name = str_replace('-', ' ', $slug);
        $locale = $this->get('request')->getLocale();
        $location = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
            ->findOneBySlugJoinedToTranslation($name, $locale);

        if ($location) {
            // Validate country from url
            $country_obj = $location->getRegion()->getCountry();
            $country_name = Intl::getRegionBundle()->getCountryName($country_obj->getName());
            if ($country_name != $country) {
                throw $this->createNotFoundException('There is no location '. $name .' on country ' . $country . '.');
            }

            foreach ($location->getSpots() as $spot) {
                $spot->translation = $spot->translate($locale);
            }

            return $this->render('SkaphandrusAppBundle:Spot:location.html.twig', array(
                'location' => $location,
                'location_translation' => $location->translate($locale),
                'country' => $country_obj,
                'country_name' => $country_name,
            ));
        }
        else {
            throw $this->createNotFoundException('The location '. $name .' does not exist.');
        }
    }

    /*
     * Country page.
     */
    public function countryAction($slug) {
        $name = str_replace('-', ' ', $slug);
        $locale = $this->get('request')->getLocale();
        $countries = Intl::getRegionBundle()->getCountryNames();

        $country = FALSE;
        if ($key = array_search($name, $countries)) {
            $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->findOneByName($key);
            $country->translation = $country->translate($locale);
        }

        $locations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
            ->findSpotsCountByLocationForCountry($country->getId());
        foreach ($locations as $location) {
            $location['location']->translation = $location['location']->translate($locale);
        }

        dump($locations);

        if ($country) {
            return $this->render('SkaphandrusAppBundle:Spot:country.html.twig', array(
                'country' => $country,
                'country_name' => Intl::getRegionBundle()->getCountryName($country->getName()),
                'locations' => $locations,
            ));
        }
        else {
            throw $this->createNotFoundException('The country '. $name .' does not exist.');
        }
    }
}
