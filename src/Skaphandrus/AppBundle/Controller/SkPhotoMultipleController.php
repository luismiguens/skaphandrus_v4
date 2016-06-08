<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * SkPhotoMultiple controller.
 *
 */
class SkPhotoMultipleController extends Controller {

    public function uploadAction() {
        $form = $this->createFormBuilder()->getForm();

        return $this->render('SkaphandrusAppBundle:SkPhoto:multiple.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
