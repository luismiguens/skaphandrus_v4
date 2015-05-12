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


class AjaxSearchController extends Controller {

    //put your code here

    
    

    public function ajaxSearchSpotAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findLikeName($q);


        $results = array();
        foreach ($spots as $spot) {
            $results[] = array(
                'id' => $spot->getId(),
                'name' => $spot->getName(),
                'label' => sprintf("[%s] %s", $spot->getName(), $spot->getName())
            );
        }

        return new JsonResponse($results);


        //return array('results' => $results);
    }

    public function getSpotAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkSpot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);

        return new Response($SkSpot->getName());
    }
    
    
    
    

    public function ajaxSearchSpeciesAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $speciess = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->findLikeName($q);


        $results = array();
        foreach ($speciess as $species) {
            $results[] = array(
                'id' => $species->getId(),
                'name' => $species->getName(),
                'label' => sprintf("[%s] %s", $species->getName(), $species->getName())
            );
        }

        return new JsonResponse($results);


        //return array('results' => $results);
    }

    public function getSpeciesAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkSpecies = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

        return new Response($SkSpecies->getName());
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
                'label' => sprintf("[%s] %s", $model->getName(), $model->getName())
            );
        }

        return new JsonResponse($results);


        //return array('results' => $results);
    }

    public function getPhotoMachineModelAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkPhotoMachineModel = $em->getRepository('SkaphandrusAppBundle:SkPhotoMachineModel')->find($id);

        return new Response($SkPhotoMachineModel->getName());
    }

}
