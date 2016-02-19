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

        return new Response($SkSpot->getName() . ", " . $SkSpot->getLocation()->getName() . ", " . $SkSpot->getLocation()->getRegion()->getCountry());
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

        //return new Response($SkLocation->getName().", ".$SkLocation()->getRegion()->getCountry());
        return new Response($SkLocation->getName() . ", " . $SkLocation->getRegion());
    }

    public function ajaxSearchSpeciesAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $speciess = $em->getRepository('SkaphandrusAppBundle:SkSpeciesScientificName')->findLikeName($q);


        $results = array();
        foreach ($speciess as $species) {
            $results[] = array(
                'id' => $species->getSpecies()->getId(),
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

    public function ajaxSearchGenusAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $genuses = $em->getRepository('SkaphandrusAppBundle:SkGenus')->findLikeName($q);


        $results = array();
        foreach ($genuses as $genus) {
            $results[] = array(
                'id' => $genus->getId(),
                'name' => $genus->getName(),
                'label' => sprintf("%s", $genus->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetGenusAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkGenus = $em->getRepository('SkaphandrusAppBundle:SkGenus')->find($id);

        return new Response($SkGenus->getName());
    }

    public function ajaxSearchFamilyAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $families = $em->getRepository('SkaphandrusAppBundle:SkFamily')->findLikeName($q);


        $results = array();
        foreach ($families as $family) {
            $results[] = array(
                'id' => $family->getId(),
                'name' => $family->getName(),
                'label' => sprintf("%s", $family->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetFamilyAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkFamily = $em->getRepository('SkaphandrusAppBundle:SkFamily')->find($id);

        return new Response($SkFamily->getName());
    }

    public function ajaxSearchOrderAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('SkaphandrusAppBundle:SkOrder')->findLikeName($q);


        $results = array();
        foreach ($orders as $order) {
            $results[] = array(
                'id' => $order->getId(),
                'name' => $order->getName(),
                'label' => sprintf("%s", $order->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetOrderAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkOrder = $em->getRepository('SkaphandrusAppBundle:SkOrder')->find($id);

        return new Response($SkOrder->getName());
    }

    public function ajaxSearchClassAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository('SkaphandrusAppBundle:SkClass')->findLikeName($q);


        $results = array();
        foreach ($classes as $class) {
            $results[] = array(
                'id' => $class->getId(),
                'name' => $class->getName(),
                'label' => sprintf("%s", $class->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetClassAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkClass = $em->getRepository('SkaphandrusAppBundle:SkClass')->find($id);

        return new Response($SkClass->getName());
    }

    public function ajaxSearchPhylumAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $phylums = $em->getRepository('SkaphandrusAppBundle:SkPhylum')->findLikeName($q);


        $results = array();
        foreach ($phylums as $phylum) {
            $results[] = array(
                'id' => $phylum->getId(),
                'name' => $phylum->getName(),
                'label' => sprintf("%s", $phylum->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetPhylumAction($id) {
        $em = $this->getDoctrine()->getManager();
        $SkPhylum = $em->getRepository('SkaphandrusAppBundle:SkPhylum')->find($id);

        return new Response($SkPhylum->getName());
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

    public function ajaxSearchFosUserAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $skPersonals = $em->getRepository('SkaphandrusAppBundle:SkPersonal')->findLikeName($q);


        $results = array();
        foreach ($skPersonals as $skPersonal) {
            $results[] = array(
                'id' => $skPersonal->getFosUser()->getId(),
                'name' => $skPersonal->getName(),
                'label' => sprintf("%s", $skPersonal->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetFosUserAction($id) {
        $em = $this->getDoctrine()->getManager();
        $fosUser = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($id);

        return new Response($fosUser->getName());
    }

    public function ajaxSearchBusinessAction(Request $request) {
        $q = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $skBusiness = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findLikeName($q);

        $results = array();
        foreach ($skBusiness as $business) {
            $results[] = array(
                'id' => $business->getId(),
                'name' => $business->getName(),
                'label' => sprintf("%s", $business->getName())
            );
        }

        return new JsonResponse($results);
    }

    public function ajaxGetBusinessAction($id) {
        $em = $this->getDoctrine()->getManager();
        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        return new Response($business->getName());
    }

}
