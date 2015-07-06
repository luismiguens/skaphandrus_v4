<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\Intl\Intl;

class ContestController extends Controller {
    
    public function landingAction() {

        $contests = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findBy(array(), array('beginAt' => 'DESC'));

        $photographers = array();
        foreach ($contests as $contest) {
            $photographers[$contest->getId()] = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findPhotographers($contest);
        }


        return $this->render('SkaphandrusAppBundle:Contest:landing.html.twig', array(
            'contests' => $contests,
            'photographers' => $photographers,
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

    public function participateAction($contest_id) {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findOneById($contest_id);

        $categoryPhotos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findPhotosFromUserInContest($user->getId(), $contest->getId());

        $categoryPhotosIds = array();
        foreach ($categoryPhotos as $cat) {
            foreach ($cat as $p) {
                $categoryPhotosIds[] = $p->getId();
            }
        }

        $userPhotos = array();
        foreach ($user->getPhotos() as $photo) {
            if (!in_array($photo->getId(), $categoryPhotosIds)) {
                $userPhotos[] = $photo;
            }
        }

        return $this->render('SkaphandrusAppBundle:Contest:participate.html.twig', array(
            'contest' => $contest,
            'categories' => $contest->getCategories(),
            'userPhotos' => $userPhotos,
            'categoryPhotos' => $categoryPhotos,
        ));
    }

    public function addPhotoAction($category_id, $photo_id) {
        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
            ->findOneById($category_id);

        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
            ->findOneById($photo_id);

        $category->addPhoto($photo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return new JsonResponse(array());
    }

    public function removePhotoAction($category_id, $photo_id) {
        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
            ->findOneById($category_id);
        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
            ->findOneById($photo_id);
        $category->removePhoto($photo);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return new JsonResponse(array());
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

        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
            ->findPhotographers($contest);

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:contest.html.twig',array(
                'contest' => $contest,
                'photographers' => $photographers,
            ));
        }
        else {
            throw $this->createNotFoundException('The contest "'. $name .'" does not exist.');
        }
    }
}
