<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;
use Cocur\Slugify\Slugify;

class SpeciesController extends Controller {

    public function taxonAction($node, $slug) {
//unsluify
        $name = $slug;
        
        $taxon_name = "Sk" . ucfirst($node);
        $repository_name = "SkaphandrusAppBundle:" . $taxon_name;

        $repository = $this->getDoctrine()->getRepository($repository_name);
        $criteria = array('name' => $name);
        $taxon = $repository->findOneBy($criteria);


        //$genus = new \Skaphandrus\AppBundle\Entity\SkGenus();
        $vernaculars = $taxon->getVernaculars();







        return $this->render('SkaphandrusAppBundle:Species:taxon.html.twig', array(
                    "node" => $node,
                    "taxon" => $taxon,
                    "vernaculars" => $vernaculars
        ));
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
}
