<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

}
