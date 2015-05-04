<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;
use Cocur\Slugify\Slugify;

class DefaultController extends Controller {


    public function indexAction() {

        return $this->render('SkaphandrusAppBundle:Default:index.html.twig');
    }
    
    public function index2Action() {

        return $this->render('SkaphandrusAppBundle:Default:index2.html.twig');
    }

    public function homepageAction($_locale) {
        return $this->render('SkaphandrusAppBundle:Default:homepage.html.twig');
    }

    public function helloAction($name) {

        return $this->render('SkaphandrusAppBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * 
     * @param type $name
     * @return type
     * 
     * Migração dos utilizadores da base de dados sfUser
     * 
     */
    public function usersMigrationAction() {


        $dbHost = $this->container->getParameter('database_host');
        $dbUser = $this->container->getParameter('database_user');
        $dbPassword = $this->container->getParameter('database_password');
        $dbName = $this->container->getParameter('database_name');
        $dbPort = $this->container->getParameter('database_port');

        $em = $this->container->get('doctrine.orm.entity_manager');
        $um = $this->container->get('fos_user.user_manager');

        $mysqli = new \mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);
        $result = $mysqli->query('SELECT * FROM sf_guard_user');
        $userSfGuard = $result->fetch_object();

        

        
        
        while ($userSfGuard = $result->fetch_object()) {
            $userFOS = $um->createUser();
            $userFOS->SetId($userSfGuard->username);
            $userFOS->setUsername($userSfGuard->username);
            $userFOS->setEmail($userSfGuard->username);
            $userFOS->setPassword($userSfGuard->password);
            $userFOS->setSalt($userSfGuard->salt);

            $em->persist($userFOS);
        }
        $em->flush();





        return $this->render('SkaphandrusAppBundle:Default:usersMigration.html.php');
    }

    public function taxonAction($node, $slug) {
        $taxon_name = ucfirst($node);
        $taxon = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:Sk" . $taxon_name)
            ->findOneBy(array('name' => $slug));

        if ($taxon) {
            return $this->render('SkaphandrusAppBundle:Default:taxon.html.twig', array(
                "node" => $node,
                "taxon" => $taxon,
            ));
        }
        else {
            throw $this->createNotFoundException('The '. $taxon_name .' "'. $slug .'" does not exist.');
        }
    }

    public function speciesPageAction($slug) {
        $request = $this->get('request');
        $locale = $request->getLocale();
        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
            ->findBySlug($slug);

        if ($species) {
            return $this->render('SkaphandrusAppBundle:Default:species.html.twig', array(
                "species" => $species,
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
        $locale = $this->get('request')->getLocale();
        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
            ->findBySlug($slug, $location, $country, $locale);
        
        if ($spot) {
            return $this->render('SkaphandrusAppBundle:Default:spot.html.twig', array(
                'spot' => $spot,
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
            ->findBySlug($name, $country, $locale);

        if ($location) {
            return $this->render('SkaphandrusAppBundle:Default:location.html.twig', array(
                'location' => $location,
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
        $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->findBySlug($slug);
        
        $locations = array();
        foreach ($country->getRegions() as $region) {
            foreach ($region->getLocations() as $location) {
                $locations[] = $location;
            }
        }

        if ($country) {
            return $this->render('SkaphandrusAppBundle:Default:country.html.twig', array(
                'country' => $country,
                'country_name' => $slug,
                'locations' => $locations,
            ));
        }
        else {
            throw $this->createNotFoundException('The country '. $name .' does not exist.');
        }
    }

    /*
     * Photo page.
     */
    public function photoAction($id, $slug) {
        $title = str_replace('-', ' ', $slug);

        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
            ->findOneBy(array('id' => $id, 'title' => $title));

        if ($photo) {
            return $this->render('SkaphandrusAppBundle:Default:photo.html.twig', array(
                'photo' => $photo,
            ));
        }
        else {
            throw $this->createNotFoundException('The photo "'. $title .'" with id "'. $id .'" does not exist.');
        }
    }

    /*
     * User page.
     */
    public function userAction($id, $username) {
        $user = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
            ->findOneBy(array('id' => $id, 'username' => $username));

        if ($user) {
            return $this->render('SkaphandrusAppBundle:Default:user.html.twig', array(
                'user' => $user,
            ));
        }
        else {
            throw $this->createNotFoundException('The user "'. $username .'" with id "'. $id .'" does not exist.');
        }
    }
}
