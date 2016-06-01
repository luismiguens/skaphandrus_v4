<?php

namespace Skaphandrus\AppBundle\Controller;

use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Entity\SkPersonal;
use Skaphandrus\AppBundle\Entity\SkPhotoContest;
use Skaphandrus\AppBundle\Entity\SkPhotoContestAward;
use Skaphandrus\AppBundle\Entity\SkPhotoContestCategory;
use Skaphandrus\AppBundle\Entity\SkPhotoContestJudge;
use Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Testes controller.
 *
 */
class TestesController extends Controller {

    public function testeEmailAction() {

        $user = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findOneBy(array('id' => 5));

        return $this->render('SkaphandrusAppBundle:Email:content_email.html.twig', array(
                    'user' => $user,
        ));
    }

}
