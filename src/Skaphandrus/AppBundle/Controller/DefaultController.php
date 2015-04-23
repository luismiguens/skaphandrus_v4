<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

}
