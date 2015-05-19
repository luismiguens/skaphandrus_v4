<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxSearchController
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\HttpFoundation\Response as Response;



class AjaxSearchController extends Controller {

    //put your code here

    
    

    public function ajaxSearchSpotAction(Request $request) {
        
         $locale = $this->get('request')->getLocale();
         
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findLikeName($q, $locale);


        $results = array();
        foreach ($spots as $spot) {
            $results[] = array(
                'id' => $spot->getId(),
                'name' => $spot->getName(),
                'label' => sprintf("%s, %s, %s", $spot->getName(), $spot->getLocation()->getName(), $spot->getLocation()->getRegion()->getCountry())
            );
        }

        return new JsonResponse($results);
    }

    
    
    
    public function ajaxGetSpotAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkSpot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);

        return new Response($SkSpot->getName().", ".$SkSpot->getLocation()->getName().", ".$SkSpot->getLocation()->getRegion()->getCountry());
    }
    
    
        public function ajaxSearchLocationAction(Request $request) {
        
         $locale = $this->get('request')->getLocale();
         
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('SkaphandrusAppBundle:SkLocation')->findLikeName($q, $locale);


        $results = array();
        foreach ($locations as $location) {
            $results[] = array(
                'id' => $location->getId(),
                'name' => $location->getName(),
                'label' => sprintf("%s, %s", $location->getName(), $location->getRegion()->getCountry())
            );
        }

        return new JsonResponse($results);
    }

    
    
    
    public function ajaxGetLocationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkLocation = $em->getRepository('SkaphandrusAppBundle:SkLocation')->find($id);

        return new Response($SkLocation->getName().", ".$SkLocation()->getRegion()->getCountry());
    }
    
    
    
    

    public function ajaxSearchSpeciesAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $speciess = $em->getRepository('SkaphandrusAppBundle:SkSpeciesScientificName')->findLikeName($q);


        $results = array();
        foreach ($speciess as $species) {
            $results[] = array(
                'id' => $species->getId(),
                'name' => $species->getName(),
                //'label' => sprintf("[%s] %s", $species->getName(), $species->getName())
                'label' => sprintf("%s", $species->getName())
            );
        }

        return new JsonResponse($results);


        //return array('results' => $results);
    }

    public function ajaxGetSpeciesAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkSpecies = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

        return new Response($SkSpecies->getScientificNames()[0]);
    }
    
    
    

    public function ajaxSearchPhotoMachineModelAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $models = $em->getRepository('SkaphandrusAppBundle:SkPhotoMachineModel')->findLikeName($q);


        $results = array();
        foreach ($models as $model) {
            $results[] = array(
                'id' => $model->getId(),
                'name' => $model->getName(),
                'label' => sprintf("%s", $model->getName())
            );
        }

        return new JsonResponse($results);


        //return array('results' => $results);
    }

    public function ajaxGetPhotoMachineModelAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkPhotoMachineModel = $em->getRepository('SkaphandrusAppBundle:SkPhotoMachineModel')->find($id);

        return new Response($SkPhotoMachineModel->getName());
    }

}
