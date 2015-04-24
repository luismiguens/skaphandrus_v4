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

        $repository = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkSpeciesScientificName");
        $scientific_name = $repository->findOneBy(array('name' => $name));

        if ($scientific_name) {
            $species = $scientific_name->getSpecies();

            $vernaculars = array();
            foreach ($species->getSpeciesVernaculars() as $v) {
                $vernaculars[] = array(
                    'name' => $v->getVernacular()->getName(),
                    'language' => Intl::getLocaleBundle()->getLocaleName($v->getLocale()),
                );
            }

            return $this->render('SkaphandrusAppBundle:Species:species.html.twig', array(
                "species" => $species,
                "species_sn" => $scientific_name,
                "vernaculars" => $vernaculars,
                "description" => $species->translate($locale)->getDescription(),
                "how_to_find" => $species->translate($locale)->getHowToFind(),
                //"characters" => $species->getIdentificationCharacter()->translate($locale)->getName(),
            ));
        }
        else {
            throw $this->createNotFoundException('The species '. $name .' does not exist.');
        }
    }
}
