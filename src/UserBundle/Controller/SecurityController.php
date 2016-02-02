<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController {

    public function loginAction() {

        echo "asd";

//        $response = parent::loginAction();
        // ... do custom stuff
//        return $response;
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data) {

        dump("asd");
//        return $this->render('FOSUserBundle:Security:login.html.twig', $data);
    }

}
