<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;
use Cocur\Slugify\Slugify;

class SpeciesController extends Controller {

    public function taxonAction($node, $slug) {
//unsluify
        $name = $slug;
        $taxon_name = ucfirst($node);
        $taxon = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:Sk" . $taxon_name)
            ->findOneBy(array('name' => $name));

        if ($taxon) {
            // Get common names.
            $vernaculars = array();
            $vernaculars_text = array();
            foreach ($taxon->getVernaculars() as $v) {
                $vernaculars[] = array(
                    'name' => $v->getName(),
                    'language' => '(' . Intl::getLocaleBundle()->getLocaleName($v->getLocale()) . ')',
                );
            }

            return $this->render('SkaphandrusAppBundle:Species:taxon.html.twig', array(
                "node" => $node,
                "taxon" => $taxon,
                "vernaculars" => $vernaculars,
            ));
        }
        else {
            throw $this->createNotFoundException('The '. $taxon_name .' "'. $name .'" does not exist.');
        }
    }

    public function speciesPageAction($slug) {
        $request = $this->get('request');
        $locale = $request->getLocale();

        $name = str_replace('-', ' ', $slug);

        $scientific_name = $this->getDoctrine()
            ->getRepository("SkaphandrusAppBundle:SkSpeciesScientificName")
            ->findOneBy(array('name' => $name));

        if ($scientific_name) {
            $species = $scientific_name->getSpecies();

            // Get common names.
            $vernaculars = array();
            $vernaculars_text = array();
            foreach ($species->getSpeciesVernaculars() as $v) {
                $vname = $v->getVernacular()->getName();
                $vlocale = Intl::getLocaleBundle()->getLocaleName($v->getLocale());
                $vernaculars_text[] = $vname . ' (' . ($vlocale? $vlocale : 'Not recognized') . ')';

                $vernaculars[] = array(
                    'name' => $vname,
                    'language' => $vlocale,
                );
            }

            // Get criteria.
            $criteria = array();
            foreach ($species->getCharacter() as $c) {
                $criteria[] = array(
                    'name' => $c->getCriteria()->translate($locale)->getName(),
                    'image' => $c->getImage(),
                );
            }

            // Get photos.
            $photos = $species->getPhotos();

            return $this->render('SkaphandrusAppBundle:Species:species.html.twig', array(
                "species" => $species,
                "species_sn" => $scientific_name,
                "vernaculars" => $vernaculars,
                "vernaculars_text" => implode(', ', $vernaculars_text) . '.',
                "description" => $species->translate($locale)->getDescription(),
                "how_to_find" => $species->translate($locale)->getHowToFind(),
                "criteria" => $criteria,
                "photo" => count($photos)? $photos[0]->getPhoto() : NULL,
                "users" => $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkPhoto")
                    ->findPhotosCountByUserForModel($species->getId()),
            ));
        }
        else {
            throw $this->createNotFoundException('The species '. $name .' does not exist.');
        }
    }

    public function spotAction($country, $location, $slug) {
        $name = str_replace('-', ' ', $slug);
        $locale = $this->get('request')->getLocale();

//        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
//            ->findOneByName($name);

        
        
        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findOneBySlugJoinedToTranslation($name);
        
        
        if ($spot) {

            $location = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
            ->findOneByName($location);

            //$country = $location->getCountry();


            return $this->render('SkaphandrusAppBundle:Species:spot.html.twig', array(
                'spot' => $spot,
                'spot_name' => $spot->translate($locale)->getName(),
                'location' => $location,
                'location_name' => $location->translate($locale)->getName(),
            ));
        }
        else {
            throw $this->createNotFoundException('The spot '. $name .' does not exist.');
        }
    }
}
