<?php

namespace Skaphandrus\AppBundle\Controller;

// Used Entities
// Used Forms

use Ivory\GoogleMap\Exception\OverlayException;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $modules = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
                ->findBy(array('isEnabled' => '1'), array('updatedAt' => 'DESC'), 8);

        $contestInProgress = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findContestInProgress();

        $contestEnded = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findContestEnded();

//        $contests = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')
//                ->findBy(array('isVisible' => true), array('createdAt' => 'DESC'), 8);

        $photos = $em->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findBy(array(), array('createdAt' => 'DESC'), 15);

        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->findBy(array(), array('createdAt' => 'DESC'), 3);

//        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findBusinessPremiumOrPlus();

        return $this->render('SkaphandrusAppBundle:Default:index.html.twig', array(
                    'modules' => $modules,
                    'contestInProgress' => $contestInProgress,
                    'contestEnded' => $contestEnded,
                    'photos' => $photos,
                    'business' => $business,
        ));
    }

    public function testThumbnailAction() {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findBy(array('fosUser' => '5'), array('id' => 'DESC'), 10);

        return $this->render('SkaphandrusAppBundle:Default:testThumbnail.html.twig', array('photos' => $photos));
    }

    public function testSmartLinkAction() {

        return $this->render('SkaphandrusAppBundle:Default:testSmartLink.html.twig');
    }

    public function index2Action() {
//        $location = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
//                ->findOneWithTranslations(21);

        return $this->render('SkaphandrusAppBundle:Default:index2.html.twig');
    }

    public function homepageAction() {
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
        $em->getClassMetaData(get_class(new FosUser()))
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
        $locale = $this->get('request')->getLocale();

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
                                'node' => $this->get('translator')->trans($taxon),
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
                    'node' => $this->get('translator')->trans('kingdom'),
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
                            'node' => $this->get('translator')->trans('kingdom'),
                            'slug' => $object->getName(),
                        )),
                    ),
                );
            }
        }

        return new JsonResponse($response);
    }

    public function taxonAction($node, $slug) {

        $node = lcfirst($node);

        switch ($node) {
            case 'género':
                $node = 'genus';
                break;
            case 'família':
                $node = 'family';
                break;
            case 'ordem':
                $node = 'order';
                break;
            case 'classe':
                $node = 'class';
                break;
            case 'filo':
                $node = 'phylum';
                break;
            case 'reino':
                $node = 'kingdom';
                break;
            default:
                break;
        }

        $taxon_name = ucfirst($node);

        $taxon = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:Sk" . $taxon_name)
                ->findOneBy(array('name' => $slug));

        if ($taxon) {

            $structure = Utils::taxonomyStructure();

            //next taxon é o nome dos nós filhos, ou seja se estamos numa familia = generos(genus)
            $next_taxon = "";
            if (array_key_exists($node, $structure)) {
                $next_taxon = $structure[$node]['next'];
            } elseif ($node = 'kingdom') {
                $next_taxon = 'phylum';
            }

            foreach ($taxon->getChildNodes() as $child) {
                $photos = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkPhoto")
                                ->getQueryBuilder4(array($child->getTaxonNodeName() => $child->getId()), 10)->getQuery()->getResult();
                $child->setPhotos($photos);
            }

//            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                    ->findUsersInTaxon($next_taxon, $taxon->getTaxonNodeName(), $taxon->getId());
//
//            $photographers = array();
//            dump($taxon);
//            $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder([$taxon->getTaxonNodeName() => $taxon->getId()], 20);
//
//            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                    ->createNativeNamedQuery('fetchTagsByExpertise')
//                    ->getResult();
//            dump($photographers);

            return $this->render('SkaphandrusAppBundle:Default:taxon.html.twig', array(
                        "node" => $node,
                        "taxon" => $taxon,
                        "next_taxon" => $next_taxon
//                        "photographers" => $photographers
            ));
        } else {
            throw $this->createNotFoundException('The ' . $taxon_name . ' "' . $slug . '" does not exist.');
        }
    }

    public function speciesPageAction($slug) {

        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->findBySlug($slug);
        $photos = array();
//        $criterias = array();

        if ($species) {

            $spots = array();

            foreach ($species->getPhotos() as $photo) {
                if ($photo->getSpot() != null):
                    $spots[] = $photo->getSpot();
                endif;
            }

            $map = null;
            $latitude = 0;
            $longitude = 0;
            $centerLatitude = 0;
            $centerLongitude = 0;

            if (count($spots) > 0) {

                // Get markers from spots for the map
                $markers = array();

                foreach ($spots as $spot) {

                    //dump($spot->getCoordinate());
                    if ($spot->getCoordinate()) {

                        try {

                            $marker = new Marker();

                            //remove white spaces
                            $latitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[0]);
                            $longitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[1]);

                            $infowindow = new InfoWindow();
                            $spot_url = $this->generateUrl('spot', array(
                                'slug' => $spot->getName(),
                                'location' => $spot->getLocation(),
                                'country' => $spot->getLocation()->getRegion()->getCountry()
                            ));

                            $location_url = $this->generateUrl('location', array(
                                'slug' => $spot->getLocation(),
                                'country' => $spot->getLocation()->getRegion()->getCountry()
                            ));

                            $country_url = $this->generateUrl('country', array(
                                'slug' => $spot->getLocation()->getRegion()->getCountry()
                            ));

                            $contentString = "<a href=" . $spot_url . ">" . $spot->getName() . ",</a>
                                <a href=" . $location_url . "> " . $spot->getLocation() . ",</a>
                                <a href=" . $country_url . "> " . $spot->getLocation()->getRegion()->getCountry() . "</a>";

                            $infowindow->setContent($contentString);
                            $infowindow->setAutoClose(TRUE);

                            // Marker options
                            $marker->setInfoWindow($infowindow);
                            $marker->setPrefixJavascriptVariable('marker_');
                            $marker->setPosition($latitude, $longitude, true);
                            $marker->setAnimation(Animation::DROP);
                            $marker->setOption('clickable', true);
                            $marker->setOption('flat', true);
                            $marker->setOptions(array(
                                'clickable' => true,
                                'flat' => true,
                            ));

                            $markers[] = $marker;
                        } catch (OverlayException $ex) {
                            //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                        } catch (InvalidParameterException $ex) {
                            //erro da constraução do url
                        }
                    }
                }

                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
                $map->setCenter($centerLatitude, $centerLongitude, true);
                $map->setMapOption('zoom', 3);
                $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $map->setMapOption('disableDefaultUI', true);
                $map->setMapOption('disableDoubleClickZoom', true);
                $map->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
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

//            //ir buscar ids das melhores fotografias
//            $p = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkSpecies")
//                    ->getPhotosForIdentification($species->getId(), 0, 7);
//            //para cada id ir buscar o object
//            foreach ($p as $key => $ph) {
//                $photo = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkPhoto")->findOneById($ph['id']);
//                $photos[] = $photo;
//            }
//            
//            
//            
            //ir bucar photo com species_id = species_id and is_primary = 1
            $photoPrimary = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                    ->isPrimaryPhoto($species->getId());

            $species->setPrimaryPhoto($photoPrimary);

            //ir buscar especies da mesma ordem
            $species_ids = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                    ->findSpeciesInOrder($species, 10);

            //para cada especie ir buscar a melhor fotografia(devolve array)
            foreach ($species_ids as $key => $id) {
                $bestPhotos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                        ->getPhotosForIdentification($id['id'], null, 1);

                $similarSpecies[] = $this->getDoctrine()
                        ->getRepository("SkaphandrusAppBundle:SkPhoto")
                        ->findOneById($bestPhotos[0]['id']);
            }

//            //ir buscar a lista de id de criterios da especie
//            $criterias_ids = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkIdentificationCriteria")->getCriteriasFromSpecies($species->getId());
//
//            //ir buscar os criterios e todos os caracteres do criterio
//            foreach ($criterias_ids as $key => $criteria) {
//                $criterias[] = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->findCriteriaJoinAllCharacters($criteria);
//            }
//
//            foreach ($criterias as $key => $criteria) :
//                foreach ($criteria->getCharacters() as $key => $character):
//                    $isFromSpecies = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')->isCharacterFromSpecies($species->getId(), $character->getId());
//                    $character->setIsFromSpecies($isFromSpecies);
//                endforeach;
//            endforeach;

            return $this->render('SkaphandrusAppBundle:Default:species.html.twig', array(
                        "species" => $species,
                        "similarSpecies" => $similarSpecies,
                        "spots" => $spots,
                        'map' => $map,
                        'map_center_lat' => $centerLatitude,
                        'map_center_lon' => $centerLongitude
//                        "photos" => $photos,
//                        "criterias" => $criterias,
//                        "allCriterias" => $allCriterias
//                        "users" => $users
            ));
        } else {
            throw $this->createNotFoundException('The species ' . $species . ' does not exist.');
        }
    }

    /*
     * Users Home page
     */

    public function usersHomeAction() {

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT u FROM SkaphandrusAppBundle:SkUserResults u join SkaphandrusAppBundle:FosUser f WITH u.id = f.id order by u.photos desc";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        // parameters to template
        return $this->render('SkaphandrusAppBundle:Default:users-home.html.twig', array(
                    'pagination' => $pagination,
        ));
    }

    public function business_no_slugAction($id) {

        $business = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->find($id);

        return $this->redirect($this->generateUrl('business', array('country' => Utils::slugify($business->getAddress()->getLocation()->getRegion()->getCountry()),
                            'location' => Utils::slugify($business->getAddress()->getLocation()),
                            'slug' => Utils::slugify($business->getName()))));
    }

    /*
     * Business Page 
     */

    public function businessAction($country, $location, $slug) {

        $em = $this->getDoctrine()->getManager();

        $locale = $this->get('request')->getLocale();
        $business = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->findBySlug($country, $location, $slug, $locale);

        if ($business) {

            $photosCount = $em->createQuery('SELECT count(p.id) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.business = ?1')->setParameter(1, $business->getId())->getSingleScalarResult();
            $speciesCount = $em->createQuery('SELECT COUNT(DISTINCT(p.species)) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.business = ?1')->setParameter(1, $business->getId())->getSingleScalarResult();
            $photographersCount = $em->createQuery('SELECT COUNT(DISTINCT(p.fosUser)) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.business = ?1')->setParameter(1, $business->getId())->getSingleScalarResult();

            $map = null;
            $latitude = 0;
            $longitude = 0;
            $centerLatitude = 0;
            $centerLongitude = 0;

            //$business = new \Skaphandrus\AppBundle\Entity\SkBusiness();
            if ($business->getAddress()->getCoordinate() != null) {

                if (count($business->getAddress()->getLocation()) > 0) {

                    try {

                        // Get markers from spots for the map
                        $markers = array();
                        $marker = new Marker();

                        //remove white spaces
                        $latitude = preg_replace('/\s+/', '', explode(",", $business->getAddress()->getCoordinate())[0]);
                        $longitude = preg_replace('/\s+/', '', explode(",", $business->getAddress()->getCoordinate())[1]);
                        $zoom = $business->getAddress()->getZoom();

                        $infowindow = new InfoWindow();
                        if ($business->getAddress()->getStreet()) {
                            $contentString = $business->getName() . '<br/> ' . $business->getAddress()->getStreet() . ', ' . $business->getAddress()->getLocation()->getName() . ', ' . $business->getAddress()->getLocation()->getRegion()->getCountry();
                        } else {
                            $contentString = $business->getName() . '<br/> ' . $business->getAddress()->getLocation()->getName() . ', ' . $business->getAddress()->getLocation()->getRegion()->getCountry();
                        }
                        $infowindow->setContent($contentString);
                        $infowindow->setOption('maxWidth', 250);

                        // Marker options
                        $marker->setInfoWindow($infowindow);
                        $marker->setPrefixJavascriptVariable('marker_');
                        $marker->setPosition($latitude, $longitude, true);
                        $marker->setAnimation(Animation::DROP);
                        $marker->setOption('clickable', true);
                        $marker->setOption('flat', true);
                        $marker->setOptions(array(
                            'clickable' => true,
                            'flat' => true,
                        ));

                        // $totalLatitude += $latitude;
                        // $totalLongitude += $longitude;
                        $markers[] = $marker;
                    } catch (OverlayException $ex) {
                        //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                    } catch (InvalidParameterException $ex) {
                        //erro da constraução do url
                    }
                }


                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
                $map->setPrefixJavascriptVariable('map_');
                $map->setHtmlContainerId('map_canvas');
                $map->setAsync(false);
                $map->setCenter($centerLatitude, $centerLongitude, true);
                $map->setMapOption('zoom', intval($zoom));
                $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $map->setMapOption('disableDefaultUI', true);
                $map->setMapOption('disableDoubleClickZoom', true);
                $map->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
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

            $mapSpot = null;
            $latitudeSpot = 0;
            $longitudeSpot = 0;
            $centerLatitudeSpot = 0;
            $centerLongitudeSpot = 0;

            if (count($business->getSpot()) > 0) {

                // Get markers from spots for the map
                $markersSpot = array();
                // $totalLatitude = 0;
                // $totalLongitude = 0;
                foreach ($business->getSpot() as $spot) {

                    //dump($spot->getCoordinate());

                    if ($spot->getCoordinate()) {

                        try {
                            $markerSpot = new Marker();

                            //remove white spaces
                            $latitudeSpot = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[0]);
                            $longitudeSpot = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[1]);

                            $infowindow = new InfoWindow();

                            //$utils = new \Skaphandrus\AppBundle\Twig\UtilsExtension($this->container, $this->get('translator'));
                            //$contentString = $utils->link_to_spot($spot->getName(), $spot->getLocation(), $spot->getLocation()->getRegion()->getCountry());
                            //$contentString = $spot->getName();
                            $spot_url = $this->generateUrl('spot', array(
                                'slug' => $spot->getName(),
                                'location' => $spot->getLocation(),
                                'country' => $spot->getLocation()->getRegion()->getCountry()
                            ));

                            $contentString = "<a href=" . $spot_url . ">" . $spot->getName() . "</a>";

                            $infowindow->setContent($contentString);
                            $infowindow->setAutoClose(TRUE);

                            // Marker options
                            $markerSpot->setInfoWindow($infowindow);
                            $markerSpot->setPrefixJavascriptVariable('marker_spot_');
                            $markerSpot->setPosition($latitudeSpot, $longitudeSpot, true);
                            $markerSpot->setAnimation(Animation::DROP);
                            $markerSpot->setOption('clickable', true);
                            $markerSpot->setOption('flat', true);
                            $markerSpot->setOptions(array(
                                'clickable' => true,
                                'flat' => true,
                            ));

                            // $totalLatitude += $latitudeSpot;
                            // $totalLongitude += $longitudeSpot;
                            $markersSpot[] = $markerSpot;
                        } catch (OverlayException $ex) {
                            //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                        } catch (InvalidParameterException $ex) {
                            //erro da constraução do url
                        }
                    }
                }

                // Create the map
                // $centerLatitudeSpot = $totalLatitude / count($markersSpot);
                // $centerLongitudeSpot = $totalLongitude / count($markersSpot);
                // $centerLatitudeSpot = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[0];
                // $centerLongitudeSpot = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[1];

                $centerLatitudeSpot = $latitudeSpot;
                $centerLongitudeSpot = $longitudeSpot;

                $mapSpot = new Map();
                $mapSpot->setPrefixJavascriptVariable('map_spot_');
                $mapSpot->setHtmlContainerId('map_canvas_spot');
                $mapSpot->setAsync(false);
                $mapSpot->setCenter($centerLatitudeSpot, $centerLongitudeSpot, true);
                $mapSpot->setMapOption('zoom', 10);
                $mapSpot->setMapOption('mapTypeId', MapTypeId::ROADMAP);
                $mapSpot->setMapOption('disableDefaultUI', true);
                $mapSpot->setMapOption('disableDoubleClickZoom', true);
                $mapSpot->setMapOptions(array(
                    'disableDefaultUI' => true,
                    'disableDoubleClickZoom' => true,
                ));
                $mapSpot->setStylesheetOptions(array(
                    'width' => 'auto',
                    'height' => '300px',
                ));
                $mapSpot->setLanguage('en');

                // Add the spots to the map
                foreach ($markersSpot as $markerSpot) {
                    $mapSpot->addMarker($markerSpot);
                }
            }

//            $map = $this->getMapAddress($business);
//            $mapSpot = $this->getMapSpots($business);

            return $this->render('SkaphandrusAppBundle:Default:business.html.twig', array(
                        'business' => $business,
                        'photosCount' => $photosCount,
                        'speciesCount' => $speciesCount,
                        'photographersCount' => $photographersCount,
                        'map' => $map,
                        'mapSpot' => $mapSpot,
            ));
        } else {
            throw $this->createNotFoundException('The business "' . $slug . '" does not exist in the location ' . $location . ' or country ' . $country);
        }
    }

    /*
     * Destinations page
     */

    public function destinationsAction() {
//
        $continents = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkContinent')
                ->findAll();

//        $continent = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkContinent')
//                ->find(6);
//                
//        $country = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
//                ->find(166);

        foreach ($continents as $continent) {
            $countries = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkCountry')
                    ->findCountriesWithSpots($continent->getId());
            $continent->setCountries($countries);
        }

        return $this->render('SkaphandrusAppBundle:Default:destinations.html.twig', array(
                    'continents' => $continents
        ));
    }

    /*
     * Spot Page 
     */

    public function spotAction($country, $location, $slug) {
        $locale = $this->get('request')->getLocale();
        $spot = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                ->findBySlug($slug, $location, $country, $locale);

        $spot->setPhotosInSpot(count($spot->getPhotos()));
        $spot->setPhotos($this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')->findPhotosSpot($spot->getId()));

        $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->findDiveCentersInSpot($spot->getId());

        $liveaboards = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->findLiveaboardsInSpot($spot->getId());

        $accommodations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                ->findAccommodationsInSpot($spot->getId());

////        photos
//        $qb_photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->getQueryBuilder(['spot' => $spot], 20);
//        $query_photos = $qb_photos->getQuery();
//        $photos = $query_photos->getResult();
////        photographers
//        $qb_photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder(['spot' => $spot], 20);
//        $query_photographers = $qb_photographers->getQuery();
//        $photographers = $query_photographers->getResult();
//
//        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                ->findSpeciesInSpot($spot->getId());
//
//        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                ->findUsersInSpot($spot->getId());
//
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

        $map = null;
        $latitude = 0;
        $longitude = 0;
        $centerLatitude = 0;
        $centerLongitude = 0;

        if (count($spot->getLocation()->getSpots()) > 0) {

            // Get markers from spots for the map
            $markers = array();

            foreach ($spot->getLocation()->getSpots() as $s) {

                //dump($spot->getCoordinate());

                if ($s->getCoordinate()) {

                    try {

                        $marker = new Marker();

                        //remove white spaces
                        $latitude = preg_replace('/\s+/', '', explode(",", $s->getCoordinate())[0]);
                        $longitude = preg_replace('/\s+/', '', explode(",", $s->getCoordinate())[1]);

                        $infowindow = new InfoWindow();
                        $s_url = $this->generateUrl('spot', array(
                            'slug' => $s->getName(),
                            'location' => $s->getLocation(),
                            'country' => $s->getLocation()->getRegion()->getCountry()
                        ));

                        $contentString = "<a href=" . $s_url . ">" . $s->getName() . "</a>";

                        $infowindow->setContent($contentString);
                        $infowindow->setAutoClose(TRUE);

                        // Marker options

                        if ($spot == $s):
                            $marker->setIcon('http://maps.google.com/mapfiles/marker_green.png');
                        else:
                            $marker->setIcon('http://maps.google.com/mapfiles/marker.png');
                        endif;

                        $marker->setInfoWindow($infowindow);
                        $marker->setPrefixJavascriptVariable('marker_');
                        $marker->setPosition($latitude, $longitude, true);
                        $marker->setAnimation(Animation::DROP);
                        $marker->setOption('clickable', true);
                        $marker->setOption('flat', true);
                        $marker->setOptions(array(
                            'clickable' => true,
                            'flat' => true,
                        ));

                        $markers[] = $marker;
                    } catch (OverlayException $ex) {
                        //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                    } catch (InvalidParameterException $ex) {
                        //erro da constraução do url
                    }
                }
            }

            $centerLatitude = $latitude;
            $centerLongitude = $longitude;

            $map = new Map();
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

        if ($spot) {
            return $this->render('SkaphandrusAppBundle:Default:spot.html.twig', array(
                        'spot' => $spot,
                        'map' => $map,
                        'diveCenters' => $diveCenters,
                        'liveaboards' => $liveaboards,
                        'accommodations' => $accommodations,
//                        'photographers' => $photographers,
//                        'species' => $species,
            ));
        } else {
            throw $this->createNotFoundException('The spot ' . $spot . ' does not exist.');
        }
    }

    /*
     * Location page.
     */

    public function locationAction($country, $slug) {
        $name = Utils::unslugify($slug);
        $locale = $this->get('request')->getLocale();

        $em = $this->getDoctrine()->getManager();
        $location = $em->getRepository('SkaphandrusAppBundle:SkLocation')
                ->findBySlug($name, $country, $locale);

        if ($location) {

            $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findDiveCentersInLocation($location->getId());

            $liveaboards = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findLiveaboardsInLocation($location->getId());

            $accommodations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAccommodationsInLocation($location->getId());

//            photographers
//            $qb_photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->getQueryBuilder(['location' => $location], 20);
//            $query_photographers = $qb_photographers->getQuery();
//            $photographers = $query_photographers->getResult();
// 
//            $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
//                    ->findSpotsInLocation($location->getId(), $locale);
//
//            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                    ->findSpeciesInLocation($location->getId());
//
//            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                    ->findUsersInLocation($location->getId());
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
            $latitude = 0;
            $longitude = 0;
            $centerLatitude = 0;
            $centerLongitude = 0;


            if (count($location->getSpots()) > 0) {

                // Get markers from spots for the map
                $markers = array();
                // $totalLatitude = 0;
                // $totalLongitude = 0;
                foreach ($location->getSpots() as $spot) {

                    //dump($spot->getCoordinate());

                    if ($spot->getCoordinate()) {

                        try {

                            $marker = new Marker();

                            //remove white spaces
                            $latitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[0]);
                            $longitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[1]);

                            $infowindow = new InfoWindow();
                            //$utils = new \Skaphandrus\AppBundle\Twig\UtilsExtension($this->container, $this->get('translator'));
                            //$contentString = $utils->link_to_spot($spot->getName(), $spot->getLocation(), $spot->getLocation()->getRegion()->getCountry());
                            //$contentString = $spot->getName();
                            $spot_url = $this->generateUrl('spot', array(
                                'slug' => $spot->getName(),
                                'location' => $spot->getLocation(),
                                'country' => $spot->getLocation()->getRegion()->getCountry()
                            ));

                            $contentString = "<a href=" . $spot_url . ">" . $spot->getName() . "</a>";

                            $infowindow->setContent($contentString);
                            $infowindow->setAutoClose(TRUE);

                            // Marker options
                            $marker->setInfoWindow($infowindow);
                            $marker->setPrefixJavascriptVariable('marker_');
                            $marker->setPosition($latitude, $longitude, true);
                            $marker->setAnimation(Animation::DROP);
                            $marker->setOption('clickable', true);
                            $marker->setOption('flat', true);
                            $marker->setOptions(array(
                                'clickable' => true,
                                'flat' => true,
                            ));

                            // $totalLatitude += $latitude;
                            // $totalLongitude += $longitude;
                            $markers[] = $marker;
                        } catch (OverlayException $ex) {
                            //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                        } catch (InvalidParameterException $ex) {
                            //erro da constraução do url
                        }
                    }
                }

                // Create the map
                // $centerLatitude = $totalLatitude / count($markers);
                // $centerLongitude = $totalLongitude / count($markers);
//                $centerLatitude = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[0];
//                $centerLongitude = explode(",", $location->getSpots()->toArray()[0]->getCoordinate())[1];

                $centerLatitude = $latitude;
                $centerLongitude = $longitude;

                $map = new Map();
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
                        'map' => $map,
                        'map_center_lat' => $centerLatitude,
                        'map_center_lon' => $centerLongitude,
                        'diveCenters' => $diveCenters,
                        'liveaboards' => $liveaboards,
                        'accommodations' => $accommodations,
//                        'spots' => $spots,
//                        'photographers' => $photographers,
//                        'species' => $species,
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



//        dump($country);

        if ($country) {

            $diveCenters = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findDiveCentersInCountry($country->getId());

            $liveaboards = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findLiveaboardsInCountry($country->getId());

            $accommodations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkBusiness')
                    ->findAccommodationsInCountry($country->getId());

//            $locations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkLocation')
//                    ->findLocationsInCountry($country->getId(), $locale);
//                    
//            $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                    ->findSpeciesInCountry($country->getId());
//
//            $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                    ->findUsersInCountry($country->getId());
//                    
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

            return $this->render('SkaphandrusAppBundle:Default:country.html.twig', array(
                        'country' => $country,
                        'country_name' => $name,
                        'diveCenters' => $diveCenters,
                        'liveaboards' => $liveaboards,
                        'accommodations' => $accommodations
//                        'locations' => $locations,
//                        'species' => $species,
//                        'photographers' => $photographers,
            ));
        } else {
            throw $this->createNotFoundException('The country ' . $name . ' does not exist.');
        }
    }

    /*
     * Locations Home page
     */

    public function locationsHomeAction() {

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

        $next_photo_id = $id;
        $previous_photo_id = $id;

        $next_photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findNextPhoto($id);
        if ($next_photo):
            $next_photo_id = $next_photo->getId();
        endif;


        $previous_photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findPreviousPhoto($id);
        if ($previous_photo):
            $previous_photo_id = $previous_photo->getId();
        endif;

        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findOneById($id);

        $em = $this->getDoctrine()->getManager();

        $photosUser = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->getPhotosFromUser($photo->getFosUser());

//        $photoInContest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
//                ->getPhotoInContest($photo->getId()/* 24078 */, $locale);

        if ($photo) {
            $securityContext = $this->container->get('security.context');


            //set species is user dont set, but we have sugestion or validation
            if (!$photo->getSpecies()) {
                if (count($photo->getSpeciesValidations()) > 0) {
                    $photo->setSpecies($photo->getSpeciesValidations()[0]->getSpecies());
                    $em->persist($photo);
                    $em->flush();
                } elseif (count($photo->getSpeciesSugestions()) > 0) {
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

            $views = $photo->getViews() + 1;
            $photo->setViews($views);
            $em->persist($photo);
            $em->flush();

            $loggeduser = $this->get('security.token_storage')->getToken()->getUser();

            $votedPhoto = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestVote')
                    ->findOneBy(array('fosUser' => $loggeduser, 'category' => "behaviour"));

            //$photo = new \Skaphandrus\AppBundle\Entity\SkPhoto();

            foreach ($photo->getCategory() as $category):

                //atribuir numero de pontos dos juizes
                $category->setPointsInPhoto($this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->setPoints($photo->getId(), $category->getId()));

                //atribuir a fotografia votada pelo utilizador na categoria
//            $category->setVotedInPhoto($this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->setPoints($photo->getId(), $category->getId()));
//            
//            
            endforeach;

            return $this->render('SkaphandrusAppBundle:Default:photo.html.twig', array(
                        'photo' => $photo,
                        'previous_photo' => $previous_photo_id,
                        'next_photo' => $next_photo_id,
                        'photosUser' => $photosUser,
//                        'photoInContest' => $photoInContest,
                        'votedPhoto' => $votedPhoto,
                        'showValidation' => $showValidation,
                        'showSugestion' => $showSugestion,
                        'validationAction' => $validationAction,
                        'userValidation' => $userValidation,
                        'sugestionAction' => $sugestionAction,
                        'userSugestion' => $userSugestion
//                'categories' => $categories 
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


    public function photosAction(Request $request) {

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
        $friends = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPerson')->findByFosUser($id);

        //$user = new FosUser();

        $user = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
                ->findOneById($id);

//        $species = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                ->findSpeciesInUser($user->getId());

        $spots = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpot')
                ->findSpotsInUser($user->getId(), $locale);
//
//        $validations = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                ->getUserValidations($user->getId());
//
//        $sugestions = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                ->getUserSugestions($user->getId());


        $acquisitions = $user->getModules();

        $em = $this->getDoctrine()->getManager();

        $photosCount = $em->createQuery('SELECT COUNT(p.id) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();
        $tagsCount = 0;
        $speciesCount = $em->createQuery('SELECT COUNT(DISTINCT(p.species)) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();
        $spotsCount = $em->createQuery('SELECT COUNT(DISTINCT(p.spot)) FROM SkaphandrusAppBundle:SkPhoto p WHERE p.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();
        $friendsCount = $em->createQuery('SELECT COUNT(p.id) FROM SkaphandrusAppBundle:SkPerson p WHERE p.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();
        $modulesCount = count($acquisitions);
        $pointsCount = $user->getSettings()->getPoints();
        $validationsCount = $em->createQuery('SELECT COUNT(v.id) FROM SkaphandrusAppBundle:SkPhotoSpeciesValidation v WHERE v.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();
        $suggestionsCount = $em->createQuery('SELECT COUNT(s.id) FROM SkaphandrusAppBundle:SkPhotoSpeciesSugestion s WHERE s.fosUser = ?1')->setParameter(1, $id)->getSingleScalarResult();

        $map = null;
        $latitude = 0;
        $longitude = 0;
//        $centerLatitude = 0;
//        $centerLongitude = 0;

        if (count($spots) > 0) {

            // Get markers from spots for the map
            $markers = array();

            foreach ($spots as $spot) {

                //dump($spot->getCoordinate());
                if ($spot->getCoordinate()) {

                    try {

                        $marker = new Marker();

                        //remove white spaces
                        $latitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[0]);
                        $longitude = preg_replace('/\s+/', '', explode(",", $spot->getCoordinate())[1]);

                        $infowindow = new InfoWindow();
                        $spot_url = $this->generateUrl('spot', array(
                            'slug' => $spot->getName(),
                            'location' => $spot->getLocation(),
                            'country' => $spot->getLocation()->getRegion()->getCountry()
                        ));

                        $contentString = "<a href=" . $spot_url . ">" . $spot->getName() . "</a>";

                        $infowindow->setContent($contentString);
                        $infowindow->setAutoClose(TRUE);

                        // Marker options
                        $marker->setInfoWindow($infowindow);
                        $marker->setPrefixJavascriptVariable('marker_');
                        $marker->setPosition($latitude, $longitude, true);
                        $marker->setAnimation(Animation::DROP);
                        $marker->setOption('clickable', true);
                        $marker->setOption('flat', true);
                        $marker->setOptions(array(
                            'clickable' => true,
                            'flat' => true,
                        ));

                        $markers[] = $marker;
                    } catch (OverlayException $ex) {
                        //erro coordenada mal ex: 37.0"a"5846492309772, -8.3441162109375
                    } catch (InvalidParameterException $ex) {
                        //erro da constraução do url
                    }
                }
            }

            // Create the map
//            $centerLatitude = $latitude;
//            $centerLongitude = $longitude;

            $map = new Map();
            $map->setPrefixJavascriptVariable('map_');
            $map->setHtmlContainerId('map_canvas');
            $map->setAsync(false);
            $map->setCenter(40, 0, true);
            $map->setMapOption('zoom', 3);
//            $map->setCenter($centerLatitude, $centerLongitude, true);
//            $map->setMapOption('zoom', 10);
            $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
            $map->setMapOption('disableDefaultUI', true);
            $map->setMapOption('disableDoubleClickZoom', true);
            $map->setMapOptions(array(
                'disableDefaultUI' => true,
                'disableDoubleClickZoom' => true,
            ));
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

        if ($user) {
            return $this->render('SkaphandrusAppBundle:Default:user.html.twig', array(
                        'user' => $user,
                        'friends' => $friends,
                        //'spots' => $spots,
                        'map' => $map,
                        'acquisitions' => $acquisitions,
                        'photosCount' => $photosCount,
                        'tagsCount' => $tagsCount,
                        'speciesCount' => $speciesCount,
                        'spotsCount' => $spotsCount,
                        'friendsCount' => $friendsCount,
                        'modulesCount' => $modulesCount,
                        'pointsCount' => $pointsCount,
                        'validationsCount' => $validationsCount,
                        'suggestionsCount' => $suggestionsCount,
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

    public function skGridAction($parameters, $limit, $order = array('id' => 'desc')) {

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
