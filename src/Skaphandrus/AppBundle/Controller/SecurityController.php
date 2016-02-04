<?php

namespace Skaphandrus\AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController {

    public function loginAction(Request $request) {

        $response = parent::loginAction($request);

        return $response;
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

//        dump($data);

//        $message = $this->render('SkaphandrusAppBundle:Common:flash-message.html.twig');
//
//        if ($data) {
//            $this->addFlash(
//                    'notice', $message
//            );
//        }

        return $this->render('FOSUserBundle:Security:login.html.twig', $data);
    }

}
