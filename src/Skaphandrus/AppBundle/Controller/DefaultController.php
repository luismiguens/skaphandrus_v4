<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Translation\Translator;
use Skaphandrus\AppBundle\Utils\Utils;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\MapTypeId;
// Used Entities
use Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation;
use Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion;
// Used Forms
use Skaphandrus\AppBundle\Form\SkPhotoSpeciesValidationType;
use Skaphandrus\AppBundle\Form\SkPhotoSpeciesSugestionType;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $modules = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findBy(array('isEnabled' => '1'), array('id' => 'DESC'), 8);
        $contests = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findBy(array('isVisible' => true), array('createdAt' => 'DESC'), 8);

        return $this->render('SkaphandrusAppBundle:Default:index.html.twig', array('modules' => $modules, 'contests' => $contests));
    }

    public function testThumbnailAction() {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findBy(array('fosUser' => '5'), array('id' => 'DESC'), 100);

        return $this->render('SkaphandrusAppBundle:Default:testThumbnail.html.twig', array('photos' => $photos));
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
    public function usersMigrationActionOld() {
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
            $userFOS->setId($userSfGuard->username);
            $userFOS->setUsername($userSfGuard->username);
            $userFOS->setEmail($userSfGuard->username);
            $userFOS->setPassword($userSfGuard->password);
            $userFOS->setSalt($userSfGuard->salt);

            $em->persist($userFOS);
        }
        $em->flush();

        return $this->render('SkaphandrusAppBundle:Default:usersMigration.html.php');
    }

    /**
     * Users migration from sfUser database.
     *
     * The id is saved accordingly with:
     * http://www.ens.ro/2012/07/03/symfony2-doctrine-force-entity-id-on-persist/
     */
    public function usersMigrationAction() {
        $dbHost = $this->container->getParameter('database_host');
        $dbUser = $this->container->getParameter('database_user');
        $dbPassword = $this->container->getParameter('database_password');
        $dbName = $this->container->getParameter('database_name');
        $dbPort = $this->container->getParameter('database_port');

        $em = $this->container->get('doctrine.orm.entity_manager');
        $um = $this->container->get('fos_user.user_manager');
        $em->getClassMetaData(get_class(new \Skaphandrus\AppBundle\Entity\FosUser()))
                ->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $mysqli = new \mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);
        $result = $mysqli->query('SELECT * FROM sf_guard_user');

        $i = 0;
        while ($userSfGuard = $result->fetch_object()) {
            $userFOS = $um->createUser();
            $userFOS->setId($userSfGuard->id);
            $userFOS->setUsername($userSfGuard->username);
            $userFOS->setEmail($userSfGuard->username);
            $userFOS->setPassword($userSfGuard->password);
            $userFOS->setSalt($userSfGuard->salt);
            $userFOS->setAlgorithm($userSfGuard->algorithm);


            $em->persist($userFOS);
            $i++;
        }
        $em->flush();

        return $this->render('SkaphandrusAppBundle:Default:usersMigration.html.twig', array(
                    'total' => $i,
        ));
    }

    public function taxonomyAction() {
        return $this->render('SkaphandrusAppBundle:Default:taxonomy.html.twig');
    }

    public function sourceAction() {
        $id = $this->get('request')->query->get('id');

        $dados = explode(".", $id);
        $taxon = null;
        $result = array();
        $estado = "";
        $categ_next = "";
        $categ = "";
        $response = array();

        if ($dados[0] == "li") {
            $taxon = $dados[1];
            $parent_id = $dados[2];
        }

        $structure = Utils::taxonomyStructure();

        if (array_key_exists($taxon, $structure)) {
            $result = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:Sk" . ucfirst($taxon))
                    ->findBy(array($structure[$taxon]['parent'] => $parent_id), array('name' => 'ASC'));

            if (!$result) {
                $response[] = array('data' => 'not_exists');
            } else {
                foreach ($result as $object) {
                    $url = $this->generateUrl('taxon', array('node' => $taxon, 'slug' => $object->getName()));
                    $categ_next_id = 'li.' . $structure[$taxon]['next'] . '.' . $object->getId();

                    $response[] = array(
                        'id' => $categ_next_id,
                        'text' => $object->getName(),
                        'icon' => FALSE,
                        'state' => array('opened' => FALSE, 'selected' => FALSE),
                        'children' => TRUE,
                        'a_attr' => array(
                            'href' => $this->generateUrl('taxon', array(
                                'node' => $taxon,
                                'slug' => $object->getName(),
                            )),
                        ),
                    );
                }
            }
        } elseif ($taxon == 'species') {
            $result = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkSpecies")
                    ->findBy(array('genus' => $parent_id));

            $categ = "species";

            foreach ($result as $object) {
                $sn = $object->getScientificNames();
                $slug = Utils::slugify($sn[0]->getName());
                $url = $this->generateUrl('species', array('slug' => $slug));

                $response[] = array(
                    'text' => $sn[0]->getName() . ', ' . $sn[0]->getAuthor() . '',
                    'icon' => FALSE,
                    'state' => array('opened' => FALSE, 'selected' => FALSE),
                    'children' => FALSE,
                    'a_attr' => array(
                        'href' => $this->generateUrl('species', array(
                            'slug' => $slug,
                        )),
                    ),
                );
            }
        } elseif ($taxon == 'kingdom') {
            $result = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkKingdom")
                    ->findBy(array(), array('name' => 'ASC'));

            $categ_next = "phylum";
            $categ = "kingdom";

            foreach ($result as $object) {
                $url = $this->generateUrl('taxon', array('node' => 'kingdom', 'slug' => $object->getName()));
                $categ_next_id = 'li.phylum.' . $object->getId();
                $url = $this->generateUrl('taxon', array(
                    'node' => 'kingdom',
                    'slug' => $object->getName(),
                ));

                $response[] = array(
                    'id' => $categ_next_id,
                    'text' => $object->getName(),
                    'icon' => FALSE,
                    'state' => array('opened' => FALSE, 'selected' => FALSE, 'disabled' => FALSE),
                    'children' => TRUE,
                    'a_attr' => array(
                        'href' => $this->generateUrl('taxon', array(
                            'node' => 'kingdom',
                            'slug' => $object->getName(),
                        )),
                    ),
                );
            }
        }

        return new JsonResponse($response);
    }

    public function taxonAction($node, $slug) {
        $taxon_name = ucfirst($node);
        $taxon = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:Sk" . $taxon_name)
                ->findOneBy(array('name' => $slug));

        $structure = Utils::taxonomyStructure();

        $next_taxon = "";
        if (array_key_exists($node, $structure)) {
            $next_taxon = $structure[$node]['next'];
        } elseif ($node = 'kingdom') {
            $next_taxon = 'phylum';
        }

//        $photographers = array();
//        dump($taxon);
//        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder([$taxon->getTaxonNodeName() => $taxon->getId()], 20);

        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->findUsersInTaxon($next_taxon, $taxon->getTaxonNodeName(), $taxon->getId());

//        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                ->createNativeNamedQuery('fetchTagsByExpertise')
//                ->getResult();
//        dump($photographers);

        if ($taxon) {
            return $this->render('SkaphandrusAppBundle:Default:taxon.html.twig', array(
                        "node" => $node,
                        "taxon" => $taxon,
                        "next_taxon" => $next_taxon,
                        "photographers" => $photographers
            ));
        } else {
            throw $this->createNotFoundException('The ' . $taxon_name . ' "' . $slug . '" does not exist.');
        }
    }

    public function speciesPageAction($slug) {
        $locale = $this->get('request')->getLocale();
        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findBySlug($slug);

        if ($species) {

            $photo = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkPhoto")
                    ->getPrimaryPhotoForSpecies($species->getId());

//            $users = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkPhoto")
//                    ->findPhotosCountByUserForModel($species->getId());

            $users = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                    ->findUsersInSpecies($species->getId());

            return $this->render('SkaphandrusAppBundle:Default:species.html.twig', array(
                        "species" => $species,
                        "photo" => $photo,
                        "users" => $users
            ));
        } else {
            throw $this->createNotFoundException('The species ' . $name . ' does not exist.');
        }
    }

    public function spotAction($country, $location, $slug) {
        $locale = $this->get('request')->getLocale();
        //spot
        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                ->findBySlug($slug, $location, $country, $locale);

////        photos
//        $qb_photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getQueryBuilder(['spot' => $spot], 20);
//        $query_photos = $qb_photos->getQuery();
//        $photos = $query_photos->getResult();
////        photographers
//        $qb_photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder(['spot' => $spot], 20);
//        $query_photographers = $qb_photographers->getQuery();
//        $photographers = $query_photographers->getResult();

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                ->findSpeciesInSpot($spot->getId());

        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->findUsersInSpot($spot->getId());

////        species
//        $qb_species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->getQueryBuilder(['spot' => $spot], 20);
//        $query_species = $qb_species->getQuery();
//        $species = $query_species->getResult();
//
//        $photos_count = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->countPhotosSpotArray($spot->getId());
//        foreach ($species as $specie) {
//            if (isset($photos_count[$specie->getId()])) {
//                $specie->setPhotosCount($photos_count[$specie->getId()]);
//            }
//        }

        $marker = new Marker();

        $latitude = explode(",", $spot->getCoordinate())[0];
        $longitude = explode(",", $spot->getCoordinate())[1];



// Configure your marker options
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition($latitude, $longitude, true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOption('clickable', false);
        $marker->setOption('flat', true);
        $marker->setOptions(array(
            'clickable' => false,
            'flat' => true,
        ));




// Add your marker to the map
        //$map = $this->get('ivory_google_map.map');
        $map = new \Ivory\GoogleMap\Map();

        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setAsync(false);
//$map->setAutoZoom(true);



        $map->setCenter($latitude, $longitude, true);
        $map->setMapOption('zoom', 10);

//$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');

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



        $map->addMarker($marker);


        if ($spot) {
            return $this->render('SkaphandrusAppBundle:Default:spot.html.twig', array(
                        'spot' => $spot,
                        'photographers' => $photographers,
                        'species' => $species,
                        'map' => $map
            ));
        } else {
            throw $this->createNotFoundException('The spot ' . $name . ' does not exist.');
        }
    }

    /*
     * Location page.
     */

    public function locationAction($country, $slug) {
        $name = Utils::unslugify($slug);
        $locale = $this->get('request')->getLocale();
        $location = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
                ->findBySlug($name, $country, $locale);

        if ($location) {
            //photographers
            // $qb_photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder(['location' => $location], 20);
            // $query_photographers = $qb_photographers->getQuery();
            // $photographers = $query_photographers->getResult();

            $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                    ->findSpotsInLocation($location->getId(), $locale);

            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                    ->findSpeciesInLocation($location->getId());

            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                    ->findUsersInLocation($location->getId());

//            //species
//            $qb_species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->getQueryBuilder(['location' => $location], 20);
//            $query_species = $qb_species->getQuery();
//            $species = $query_species->getResult();
//
//            $photos_count = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->countPhotosLocationArray($location->getId());
//            foreach ($species as $specie) {
//                if (isset($photos_count[$specie->getId()])) {
//                    $specie->setPhotosCount($photos_count[$specie->getId()]);
//                }
//            }


            $map = null;
            $centerLatitude = null;
            $centerLongitude = null;


            if (count($location->getSpots()) > 0) {

                // Get markers from spots for the map
                $markers = array();
                // $totalLatitude = 0;
                // $totalLongitude = 0;
                foreach ($location->getSpots() as $spot) {
                    if ($spot->getCoordinate()) {
                        $marker = new Marker();
                        $latitude = explode(",", $spot->getCoordinate())[0];
                        $longitude = explode(",", $spot->getCoordinate())[1];

                        // Marker options
                        $marker->setPrefixJavascriptVariable('marker_');
                        $marker->setPosition($latitude, $longitude, true);
                        $marker->setAnimation(Animation::DROP);
                        $marker->setOption('clickable', false);
                        $marker->setOption('flat', true);
                        $marker->setOptions(array(
                            'clickable' => false,
                            'flat' => true,
                        ));

                        // $totalLatitude += $latitude;
                        // $totalLongitude += $longitude;
                        $markers[] = $marker;
                    }
                }

                // Create the map
                // $centerLatitude = $totalLatitude / count($markers);
                // $centerLongitude = $totalLongitude / count($markers);
                $centerLatitude = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[0];
                $centerLongitude = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[1];
                $map = new \Ivory\GoogleMap\Map();
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
            return $this->render('SkaphandrusAppBundle:Default:location.html.twig', array(
                        'location' => $location,
                        'spots' => $spots,
                        'photographers' => $photographers,
                        'species' => $species,
                        'map' => $map,
                        'map_center_lat' => $centerLatitude,
                        'map_center_lon' => $centerLongitude,
            ));
        } else {
            throw $this->createNotFoundException('The location ' . $name . ' does not exist.');
        }
    }

    /*
     * Country page.
     */

    public function countryAction($slug) {
        $name = Utils::unslugify($slug);
        $locale = $this->get('request')->getLocale();
        $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->findBySlug($slug, $locale);

        if ($country) {
            $locations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
                    ->findLocationsInCountry($country->getId(), $locale);

            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                    ->findSpeciesInCountry($country->getId());

//            $spots_count = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
//                ->countSpotsArray();
//            $photos_count = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
//                ->countPhotosArray();
//
//            foreach ($locations as $location) {
//                if (isset($spots_count[$location->getId()])) {
//                    $location->setSpotsCount($spots_count[$location->getId()]);
//                }
//                if (isset($photos_count[$location->getId()])) {
//                    $location->setPhotosCount($photos_count[$location->getId()]);
//                }
//            }
//
//            //species
//            $qb_species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->getQueryBuilder(['location' => $location], 20);
//            $query_species = $qb_species->getQuery();
//            $species = $query_species->getResult();
//
//            $photos_count = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->countPhotosCountryArray($country->getId());
//            foreach ($species as $specie) {
//                if (isset($photos_count[$specie->getId()])) {
//                    $specie->setPhotosCount($photos_count[$specie->getId()]);
//                }
//            }

            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                    ->findUsersInCountry($country->getId());

            return $this->render('SkaphandrusAppBundle:Default:country.html.twig', array(
                        'country' => $country,
                        'country_name' => $name,
                        'locations' => $locations,
                        'species' => $species,
                        'photographers' => $photographers,
            ));
        } else {
            throw $this->createNotFoundException('The country ' . $name . ' does not exist.');
        }
    }

    /*
     * Locations Home page
     */

    public function locationsHomeAction(Request $request) {

        $countries = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->findAllWithSpots();
        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countSpotsArray();
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                ->countPhotosArray();

        foreach ($countries as $country) {
            if (isset($spots[$country->getName()])) {
                $country->setSpotsCount($spots[$country->getName()]);
            }
            if (isset($photos[$country->getName()])) {
                $country->setPhotosCount($photos[$country->getName()]);
            }
        }

        return $this->render('SkaphandrusAppBundle:Default:locations-home.html.twig', array(
                    'countries' => $countries,
        ));
    }

    /*
     * Photo page.
     */

    public function photoAction($id, $slug = null) {
        $title = Utils::unslugify($slug);

        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findOneById($id);

        $em = $this->getDoctrine()->getManager();
        
        if ($photo) {
            $request = $this->get('request');
            $securityContext = $this->container->get('security.context');

            //set species is user dont set, but we have sugestion or validation
            if (!$photo->getSpecies()) {
                if (count($photo->getSpeciesValidations())>0) {
                    $photo->setSpecies($photo->getSpeciesValidations()[0]->getSpecies());
                    $em->persist($photo);
                    $em->flush();
                } elseif (count($photo->getSpeciesSugestions())>0) {
                    $photo->setSpecies($photo->getSpeciesSugestions()[0]->getSpecies());
                    $em->persist($photo);
                    $em->flush();
                }
            }



            // Check for validations
            $validations = $this->getDoctrine()->getManager()->createQuery(
                            'SELECT IDENTITY(sv.species), count(sv.species) AS validation_count
              FROM SkaphandrusAppBundle:SkPhotoSpeciesValidation sv
              WHERE IDENTITY(sv.photo) = :id
              GROUP BY sv.species
              ORDER BY validation_count DESC'
                    )->setParameter('id', $id)->getResult();

            $validationCount = 0;
            if (isset($validations[0])) {
                $validationCount = $validations[0]['validation_count'];
            }

            $showValidation = $securityContext->isGranted('ROLE_EXPERT') && $validationCount < 3;

            // Check if validation is new or not
            $validationAction = 'new';
            $userValidation = NULL;
            if ($showValidation) {
                $userValidation = $this->getDoctrine()
                        ->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')
                        ->findOneBy(array(
                    'fosUser' => $this->get('security.token_storage')->getToken()->getUser(),
                    'photo' => $photo,
                ));

                if ($userValidation) {
                    $validationAction = 'edit';
                }
            }

            $showSugestion = $securityContext->isGranted('IS_AUTHENTICATED_FULLY') && !$securityContext->isGranted('ROLE_EXPERT') && count($photo->getSpeciesSugestions()) < 10;

            // Check if sugestion is new or not
            $sugestionAction = 'new';
            $userSugestion = NULL;
            if ($showSugestion) {
                $userSugestion = $this->getDoctrine()
                        ->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')
                        ->findOneBy(array(
                    'fosUser' => $this->get('security.token_storage')->getToken()->getUser(),
                    'photo' => $photo,
                ));

                if ($userSugestion) {
                    $sugestionAction = 'edit';
                }
            }

            return $this->render('SkaphandrusAppBundle:Default:photo.html.twig', array(
                        'photo' => $photo,
                        'showValidation' => $showValidation,
                        'showSugestion' => $showSugestion,
                        'validationAction' => $validationAction,
                        'userValidation' => $userValidation,
                        'sugestionAction' => $sugestionAction,
                        'userSugestion' => $userSugestion,
            ));
        } else {
            throw $this->createNotFoundException('The photo "' . $title . '" with id "' . $id . '" does not exist.');
        }
    }

    /*
     * Photo page.
     */

//    public function photosAction() {
//        $page = $this->get('request')->query->get('page');
//        if (!$page) { $page = 1; }
//
//        $per_page = 20;
//        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
//            ->findAllAsPaginator($page, $per_page);
//        
//        // Variables for pagination
//        $visible_pages = 9;
//        $total_pages = ceil(count($photos) / $per_page);
//
//        // If current page number is less than half of visible pages in the begining...
//        if ($page < floor($visible_pages / 2)) {
//            $first_page = 1;
//            $last_page = $visible_pages;
//        }
//        // If current page number is less than half of visible pages in the end...
//        elseif ($page > $total_pages - floor($visible_pages / 2)) {
//            $last_page = $total_pages;
//            $first_page = $total_pages - $visible_pages;
//        }
//        // If current page is not close to the limit edges...
//        else {
//            $first_page = $page - floor($visible_pages / 2);
//            $last_page = $page + floor($visible_pages / 2);
//        }
//
//        return $this->render('SkaphandrusAppBundle:Default:photos.html.twig', array(
//            'photos' => $photos,
//            'pagination' => array(
//                'page' => $page,
//                'total_pages' => ceil(count($photos) / $per_page),
//                'first_page' => $first_page,
//                'last_page' => $last_page,
//            ),
//        ));
//    }


    public function photosAction(\Symfony\Component\HttpFoundation\Request $request) {

        $params = $request->query->all();

        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getQueryBuilder4($params, 30);
//        $query = $qb->getQuery();
        //var_dump($params);


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $qb, $this->get('request')->query->getInt('page', 1)/* page number */, 30/* limit per page */
//                $query, $this->get('request')->query->getInt('page', 1)/* page number */, 30/* limit per page */
        );

        // parameters to template
        return $this->render('SkaphandrusAppBundle:Default:photos.html.twig', array('pagination' => $pagination, 'params' => $params));
    }

    /*
     * User page.
     */

    public function userAction($id) {
        $locale = $this->get('request')->getLocale();

        $user = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->findOneById($id);

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                ->findSpeciesInUser($user->getId());

        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                ->findSpotsInUser($user->getId(), $locale);

        if ($user) {
            return $this->render('SkaphandrusAppBundle:Default:user.html.twig', array(
                        'user' => $user,
                        'species' => $species,
                        'spots' => $spots,
            ));
        } else {
            throw $this->createNotFoundException('The user with id "' . $id . '" does not exist.');
        }
    }

    // ############################# COMPONENTS #############################

    /*
     * Prints a board of photos.
     *
     * Include these files on the page:
     * <link rel="stylesheet" href="{{ asset('bundles/skaphandrusapp/css/plugins/blueimp/css/blueimp-gallery.min.css') }}">
     * <script src="{{ asset('bundles/skaphandrusapp/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
     */
//    public function skBoardAction($parameters, $limit = 20, $order = array('id' => 'desc')) {
//        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getQueryBuilder($parameters, $limit, $order);
////        $query = $qb->getQuery();
////        $photos = $query->getResult();
//
//        $photos = $qb->getResult();
//
//        return $this->render('SkaphandrusAppBundle:Default:skBoard.html.twig', array(
//                    'photos' => $photos,
//                    'parameters' => $parameters,
//        ));
//    }

    /*
     * Prints a grid of photos.
     *
     * Include these files on the page:
     * <link rel="stylesheet" href="{{ asset('bundles/skaphandrusapp/css/plugins/blueimp/css/blueimp-gallery.min.css') }}">
     * <script src="{{ asset('bundles/skaphandrusapp/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
     */

    public function skGridAction($parameters, $limit = 24, $order = array('id' => 'desc')) {

        // ini_set('memory_limit', '64M');

        $locale = $this->get('request')->getLocale();

        if (isset($parameters['photos'])) {
            $photos = $parameters['photos'];
            unset($parameters['photos']);
        } else {
            $conn = $this->get('database_connection');

            $sql = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                    ->getQueryForGrid($parameters, $limit, $order, 0, $locale);
            $photos = $conn->fetchAll($sql);
        }

        return $this->render('SkaphandrusAppBundle:Default:skGrid.html.twig', array(
                    'photos' => $photos,
                    'parameters' => $parameters,
        ));
    }

    public function searchAction(Request $request) {
        $string = $request->query->get('string');
        $locale = $request->getLocale();
        //$translator = new Translator($locale);



        $results = array();

        // Search Species
        $speciesSN = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                ->findScientificNameSearchResults($string, $locale);

        foreach ($speciesSN as $s) {
            $results[] = array(
                'title' => $s['title'] . ' (' . $this->get('translator')->trans('page.search.label.species') . ')',
                'url' => $this->generateUrl('species', array('slug' => Utils::slugify($s['title'])), true),
                'desc' => $s['description'],
            );
        }

        // Search Families
        $familySN = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkFamily')
                ->findLikeName($string);

        foreach ($familySN as $f) {
            $results[] = array(
                'title' => $f->getName() . ' (' . $this->get('translator')->trans('page.search.label.family') . ')',
                'url' => $this->generateUrl('taxon', array(
                    'node' => 'family',
                    'slug' => Utils::slugify($f->getName())
                        ), true),
                'desc' => '',
            );
        }

        // Search Orders
        $orderSN = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkOrder')
                ->findLikeName($string);

        foreach ($orderSN as $f) {
            $results[] = array(
                'title' => $f->getName() . ' (' . $this->get('translator')->trans('page.search.label.order') . ')',
                'url' => $this->generateUrl('taxon', array(
                    'node' => 'order',
                    'slug' => Utils::slugify($f->getName())
                        ), true),
                'desc' => '',
            );
        }

        // Search Spots
        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                ->findSearchResults($string, $locale);

        foreach ($spots as $s) {
            $country_name = Intl::getRegionBundle()->getCountryName($s['country_name']);
            $results[] = array(
                'title' => $s['title'] . ' (' . $this->get('translator')->trans('page.search.label.spot') . ')',
                'url' => $this->generateUrl('spot', array(
                    'country' => Utils::slugify($country_name),
                    'location' => Utils::slugify($s['location_name']),
                    'slug' => Utils::slugify($s['title']),
                        ), true),
                'desc' => $s['description'],
            );
        }

        // Search Locations
        $locations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
                ->findSearchResults($string, $locale);

        foreach ($locations as $l) {
            $country_name = Intl::getRegionBundle()->getCountryName($l['country_name']);
            $results[] = array(
                'title' => $l['title'] . ' (' . $this->get('translator')->trans('page.search.label.location') . ')',
                'url' => $this->generateUrl('location', array(
                    'country' => Utils::slugify($country_name),
                    'slug' => Utils::slugify($l['title']),
                        ), true),
                'desc' => $l['description'],
            );
        }

        // Search Photos
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findLikeName($string);

        foreach ($photos as $photo) {
            $results[] = array(
                'title' => $photo['title'] . ' (' . $this->get('translator')->trans('page.search.label.photo') . ')',
                'url' => $this->generateUrl('photo', array(
                    'id' => $photo['id'],
                    'slug' => Utils::slugify($photo['title']),
                        ), true),
                'desc' => $photo['description'],
            );
        }

        $users = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPersonal')
                ->findLikeName($string);

        foreach ($users as $u) {
            $fosUser = $u->getFosUser();
            $results[] = array(
                'title' => $u->getName() . ' (' . $this->get('translator')->trans('page.search.label.user') . ')',
                'url' => $this->generateUrl('user', array(
                    'id' => $fosUser->getId(),
                    'username' => $fosUser->getUsername(),
                        ), true),
                'desc' => '',
            );
        }

        // $speciesV = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
        //     ->findVernacularSearchResults($string, $locale);
        // foreach ($speciesV as $s) {
        //     $names = $s['object']->getScientificNames();
        //     $slug = Utils::slugify($names[0]->getName());
        //     $results[] = array(
        //         'title' => $s['title'],
        //         'url' => $this->generateUrl('species', array('slug' => $slug)),
        //         'desc' => $s['description'],
        //     );
        // }

        return $this->render('SkaphandrusAppBundle:Default:search.html.twig', array(
                    'string' => $string,
                    'results' => $results,
        ));
    }

}
