<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Skaphandrus\AppBundle\Utils\Utils;

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
                ->findBy(array( $structure[$taxon]['parent'] => $parent_id ), array('name' => 'ASC'));

            if (!$result) {
                $response[] = array('data' => 'not_exists');
            }
            else {
                foreach ($result as $object) {
                    $url = $this->generateUrl('taxon', array('node' => $taxon, 'slug' => $object->getName()));
                    $categ_next_id = 'li.' . $structure[$taxon]['next'] . '.' . $object->getId();
                    
                    $response[] = array(
                        'id' => $categ_next_id,
                        'text' => $object->getName(),
                        'icon' => FALSE,
                        'state' => array( 'opened' => FALSE, 'selected' => FALSE ),
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
        }
        elseif ($taxon == 'species') {
            $result = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkSpecies")
                ->findBy(array( 'genus' => $parent_id ));

            $categ = "species";

            foreach ($result as $object) {
                $sn = $object->getScientificNames();
                $slug = Utils::slugify($sn[0]->getName());
                $url = $this->generateUrl('species', array('slug' => $slug));

                $response[] = array(
                    'text' => $sn[0]->getName() . ' (' . $sn[0]->getAuthor() . ')',
                    'icon' => FALSE,
                    'state' => array( 'opened' => FALSE, 'selected' => FALSE ),
                    'children' => FALSE,
                    'a_attr' => array(
                        'href' => $this->generateUrl('species', array(
                            'slug' => $slug,
                        )),
                    ),
                );
            }
        }
        elseif ($taxon == 'kingdom') {
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
                    'state' => array( 'opened' => FALSE, 'selected' => FALSE, 'disabled' => FALSE ),
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
        }
        elseif ($node = 'kingdom') {
            $next_taxon = 'phylum';
        }

        if ($taxon) {
            return $this->render('SkaphandrusAppBundle:Default:taxon.html.twig', array(
                "node" => $node,
                "taxon" => $taxon,
                "next_taxon" => $next_taxon,
            ));
        }
        else {
            throw $this->createNotFoundException('The '. $taxon_name .' "'. $slug .'" does not exist.');
        }
    }

    public function speciesPageAction($slug) {
        $locale = $this->get('request')->getLocale();
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
        $name = Utils::unslugify($slug);
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
        $name = Utils::unslugify($slug);
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
        $title = Utils::unslugify($slug);

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
     * Photo page.
     */
    public function photosAction() {
        $page = $this->get('request')->query->get('page');
        if (!$page) { $page = 1; }

        $per_page = 20;
        $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
            ->findAllAsPaginator($page, $per_page);
        
        // Variables for pagination
        $visible_pages = 9;
        $total_pages = ceil(count($photos) / $per_page);

        // If current page number is less than half of visible pages in the begining...
        if ($page < floor($visible_pages / 2)) {
            $first_page = 1;
            $last_page = $visible_pages;
        }
        // If current page number is less than half of visible pages in the end...
        elseif ($page > $total_pages - floor($visible_pages / 2)) {
            $last_page = $total_pages;
            $first_page = $total_pages - $visible_pages;
        }
        // If current page is not close to the limit edges...
        else {
            $first_page = $page - floor($visible_pages / 2);
            $last_page = $page + floor($visible_pages / 2);
        }

        return $this->render('SkaphandrusAppBundle:Default:photos.html.twig', array(
            'photos' => $photos,
            'pagination' => array(
                'page' => $page,
                'total_pages' => ceil(count($photos) / $per_page),
                'first_page' => $first_page,
                'last_page' => $last_page,
            ),
        ));
    }

    /*
     * User page.
     */
    public function userAction($id) {
        $user = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
            ->findOneById($id);

        if ($user) {
            return $this->render('SkaphandrusAppBundle:Default:user.html.twig', array(
                'user' => $user,
            ));
        }
        else {
            throw $this->createNotFoundException('The user with id "'. $id .'" does not exist.');
        }
    }
}
