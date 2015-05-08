<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Intl;

class ContestController extends Controller {
    
    public function landingAction() {

        $contests = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findBy(array(), array('beginAt' => 'DESC'));

        return $this->render('SkaphandrusAppBundle:Contest:landing.html.twig', array(
            'contests' => $contests,
        ));
    }

    public function photosAction($contest_slug, $category_slug) {
        $locale = $this->get('request')->getLocale();

        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
            ->findOneBySlug($category_slug, $locale);

        if ($category) {
            if ($category->getContest()->getName() != str_replace('-', ' ', $contest_slug)) {
                throw $this->createNotFoundException('The category "'. $category_slug .'" does not belong to this contest.');
            }

            return $this->render('SkaphandrusAppBundle:Contest:photos.html.twig', array(
                'category' => $category,
            ));
        }
        else {
            throw $this->createNotFoundException('The category "'. $category_slug .'" does not exist.');
        }
    }

    public function photographersAction($contest_slug) {
        $name = str_replace('-', ' ', $contest_slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findOneByName($name);

        $total_photo_count = 0;
        $photographers = array();
        foreach ($contest->getCategories() as $category) {
            foreach ($category->getPhoto() as $photo) {
                $photographers[$photo->getFosUser()->getId()] = array(
                    'user' => $photo->getFosUser(),
                    'photos' => count($category->getPhoto()),
                );
            }
        }

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:photographers.html.twig',array(
                'contest' => $contest,
                'photographers' => $photographers,
            ));
        }
        else {
            throw $this->createNotFoundException('The contest "'. $name .'" does not exist.');
        }
    }

    public function sponsorsAction($contest_slug) {
        $name = str_replace('-', ' ', $contest_slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findOneByName($name);

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:sponsors.html.twig',array(
                'contest' => $contest,
            ));
        }
        else {
            throw $this->createNotFoundException('The contest "'. $name .'" does not exist.');
        }
    }

    public function contestAction($slug) {
        $name = str_replace('-', ' ', $slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findOneByName($name);

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:contest.html.twig',array(
                'contest' => $contest,
            ));
        }
        else {
            throw $this->createNotFoundException('The contest "'. $name .'" does not exist.');
        }
    }
}
