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

    public function TesteAction() {

        for ($i = 1; $i <= 10; $i++) {
            echo $i . ', ';
        }

        echo '<br>', '<br>';

        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                echo $i . '.' . $j . ", ";
            }
        }

        echo '<br>', '<br>';


        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= $i; $j++) {
                echo $i . '.' . $j . ", ";
            }
        }

        echo '<br>', '<br>';

        for ($i = 1, $j = 9; $i <= 9; $i++, $j--) {
            echo $i . '.' . $j . ", ";
        }

        echo '<br>', '<br>';

        for ($i = 1; $i <= 9; $i++) {
            echo $i . '.' . $i * $i . ", ";
        }

        return $this->render('SkaphandrusAppBundle:Testes:teste.html.twig');
    }

    public function ContestAction() {

        $name1 = new SkPersonal;
        $name1->setFirstname('ruben');

        $name2 = new SkPersonal;
        $name2->setFirstname('joao');

        $fosUser1 = new FosUser;
        $fosUser1->setPersonal($name1);

        $fosUser2 = new FosUser;
        $fosUser2->setPersonal($name2);

        $judge1 = new SkPhotoContestJudge();
        $judge1->setFosUser($fosUser1);

        $judge2 = new SkPhotoContestJudge();
        $judge2->setFosUser($fosUser2);

        $sponsor = new SkPhotoContestSponsor;
        $sponsor->setName('ruben');

        $award = new SkPhotoContestAward;
        $award->translate('en')->setName('dive');
        $award->addSponsor($sponsor);

        $category1 = new SkPhotoContestCategory();
        $category1->translate('en')->setName('peixes');
        $category1->addAward($award);

        $category2 = new SkPhotoContestCategory();
        $category2->translate('en')->setName('lulas');
        $category2->addAward($award);

        $category3 = new SkPhotoContestCategory();
        $category3->translate('en')->setName('baleias');
        $category3->addAward($award);

        $contest = new SkPhotoContest();
        $contest->setName('UW Azores');
        $contest->setBeginAt('2015.05.03');
        $contest->setEndAt('2015.05.10');
        $contest->addJudge($judge1);
        $contest->addJudge($judge2);
        $contest->addCategory($category1);
        $contest->addCategory($category2);
        $contest->addCategory($category3);

        return $this->render('SkaphandrusAppBundle:Testes:contest.html.twig', array(
                    'contest' => $contest,
        ));
    }

    
     public function indexAction(Request $request) {


        return $this->render('SkaphandrusAppBundle:Testes:index.html.twig');
    }
    
    
    public function spotAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

//        if ($limit == null and $offset == null) {
//            $limit = 10;
//            $offset = 0;
//        }

        $spots = $em->getRepository('SkaphandrusAppBundle:SkSpot')->getTenSpots($limit, $offset);

        return $this->render('SkaphandrusAppBundle:Testes:spot.html.twig', array(
                    'spots' => $spots,
        ));
    }

}
