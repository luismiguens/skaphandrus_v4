<?php

namespace Skaphandrus\MadeiraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\Intl\Intl;
use Skaphandrus\AppBundle\Entity\SkPhotoContestVote;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SkaphandrusMadeiraBundle:Default:index.html.twig', array('name' => $name));
    }

    
    
     public function contestAction($year) {
        
        $contest_id = 2;
        
        
        $contest = new \Skaphandrus\AppBundle\Entity\SkPhotoContest();

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->find($contest_id);

        $totalViews = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->countTotalViews($contest->getId());

        if ($totalViews):
            $contest->setTotalViews($totalViews);
        else:
            $totalViews = 0;
            $contest->setTotalViews($totalViews);
        endif;

        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->getPhotographers($contest->getId());

        $sponsors = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestSponsor')
                ->findSponsorsByContest($contest);

        $judges = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')
                ->findJudgesByContest($contest);
        
        
        $category_slug = $contest->getCategories()[0]->translate()->getName();

        

        if ($contest) {
            return $this->render('SkaphandrusMadeiraBundle:Default:contest.html.twig', array(
                        'contest' => $contest,
                        'photographers' => $photographers,
                        'sponsors' => $sponsors,
                        'judges' => $judges,
                'year' => $year,
                'category_slug' => $category_slug
            ));
        } else {
            throw $this->createNotFoundException('The contest does not exist.');
        }
    }
    




    public function photosAction($year, $category_slug) {

$contest_id = 2;
        
        
        $contest = new \Skaphandrus\AppBundle\Entity\SkPhotoContest();

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->find($contest_id);


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $locale = $this->get('request')->getLocale();

        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                ->findOneBySlug($contest, $category_slug, $locale);

        $category_slug = $category->translate()->getName();

        
        
        
        //dump($category);


        if ($category) {
//            if ($category->getContest()->getName() != str_replace('-', ' ', $contest_slug)) {
//                throw $this->createNotFoundException('The category "' . $category_slug . '" does not belong to this contest.');
//            }

            $votedPhoto = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestVote')
                    ->findOneBy(array('fosUser' => $user, 'category' => $category));

            return $this->render('SkaphandrusMadeiraBundle:Default:photos.html.twig', array(
                'contest' => $contest,
                        'category' => $category,
                        'votedPhoto' => $votedPhoto,
                                'year' => $year,
                'category_slug' => $category_slug
            ));
        } else {
            throw $this->createNotFoundException('The category "' . $category_slug . '" does not exist.');
        }
    }

    public function participateAction($contest_id) {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneById($contest_id);


        $userPhotos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findPhotosFromUserNotAssociatedToContest($user->getId(), $contest->getId());

        $categoryPhotos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findPhotosFromUserInContest($user->getId(), $contest->getId());

        if (!$contest->IsInProgress()) {
            return $this->redirect($this->generateUrl('contests_contest', array(
                                'slug' => $contest->getName(),
            )));
        } else {
            return $this->render('SkaphandrusAppBundle:Contest:participate.html.twig', array(
                        'contest' => $contest,
                        'categories' => $contest->getCategories(),
                        'userPhotos' => $userPhotos,
                        'categoryPhotos' => $categoryPhotos,
            ));
        }
    }

    public function addPhotoAction($category_id, $photo_id) {
        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                ->findOneById($category_id);

        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findOneById($photo_id);

        //$category->addPhoto($photo);
        $photo->addCategory($category);
//        dump($category->getId());
//        dump($photo->getId());

        $em = $this->getDoctrine()->getManager();
        $em->persist($photo);
        $em->flush();

        return new JsonResponse(array());
    }

    public function removePhotoAction($category_id, $photo_id) {
        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                ->findOneById($category_id);
        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findOneById($photo_id);
        
        
//        $category->removePhoto($photo);

        $photo->removeCategory($category);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($photo);
        $em->flush();

        return new JsonResponse(array());
    }

    public function votePhotoAction($category_id, $photo_id) {

        // Fetch needed entities
        $user = $this->get('security.token_storage')->getToken()->getUser();



        $category = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                ->findOneById($category_id);
        $photo = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')
                ->findOneById($photo_id);

        // Check if vote already exists
        $existing_vote = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestVote')
                ->findOneBy(array('fosUser' => $user, 'category' => $category));

        $em = $this->getDoctrine()->getManager();

        if ($existing_vote) {
            $em->remove($existing_vote);
            $em->flush();
        }
        $vote = new SkPhotoContestVote();
        $vote->setFosUser($user);
        $vote->setCategory($category);
        $vote->setPhoto($photo);
        $vote->setCreatedAt(new \DateTime());
        $em->persist($vote);
        $em->flush();



//        if ($existing_vote) {
//            $existing_vote->setPhoto($photo);
//            $em->persist($existing_vote);
//            $em->flush();
//        } else {
//            $vote = new SkPhotoContestVote();
//            $vote->setFosUser($user);
//            $vote->setCategory($category);
//            $vote->setPhoto($photo);
//            $vote->setCreatedAt(new \DateTime());
//            $em->persist($vote);
//            $em->flush();
//        }

        return new JsonResponse(array());
    }

    public function photographersAction($contest_slug) {
        $name = str_replace('-', ' ', $contest_slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneByName($name);

        $photographers = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->getPhotographers($contest->getId());

//        foreach ($contest->getPhotographers() as $fosUser) {
//            $photosInContest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')
//                    ->getPhotosInContest($contest->getId(), $fosUser->getId());
//
//            $fosUser->setPhotosInContest($photosInContest);
//        }

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:photographers.html.twig', array(
                        'contest' => $contest,
                        'photographers' => $photographers
            ));
        } else {
            throw $this->createNotFoundException('The contest "' . $name . '" does not exist.');
        }
    }

    public function sponsorsAction($contest_slug) {
        $name = str_replace('-', ' ', $contest_slug);

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneByName($name);

        $sponsors = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestSponsor')
                ->findSponsorsByContest($contest);

        if ($contest) {
            return $this->render('SkaphandrusAppBundle:Contest:sponsors.html.twig', array(
                        'contest' => $contest,
                        'sponsors' => $sponsors,
            ));
        } else {
            throw $this->createNotFoundException('The contest "' . $name . '" does not exist.');
        }
    }

   

    public function winnersAction($contest_slug) {
        $name = str_replace('-', ' ', $contest_slug);

        //$contest = new \Skaphandrus\AppBundle\Entity\SkPhotoContest();

        $contest = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')
                ->findOneByName($name);

        //$category = new \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory();
        foreach ($contest->getCategories() as $key => $category) {
            $category->setWinnerPhotos($this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')
                            ->findJudgeCategoryPoints($category->getId()));
        }

        if ($contest) {

            $firstPhoto = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findFirstPhotosFromSpeciesInContest($contest->getId());
            $validSpeciesPhotos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findValidatedSpeciesPhotosInContest($contest->getId());
            $validSpecies = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhotoContest')->findValidatedSpeciesInContest($contest->getId());

            return $this->render('SkaphandrusAppBundle:Contest:winners.html.twig', array(
                        'contest' => $contest,
                        'firstPhoto' => $firstPhoto,
                        'validSpeciesPhotos' => $validSpeciesPhotos,
                        'validSpecies' => $validSpecies
            ));
        } else {
            throw $this->createNotFoundException('The contest "' . $name . '" does not exist.');
        }
    }

}
