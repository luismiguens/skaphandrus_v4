<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommonController extends Controller {
    /*
     * Prints the activity feed
     *
     * Include these files on the page:

     */

    public function skActivityAction($parameters, $limit = 10, $order = array('created_at' => 'desc')) {


        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        $sql = "SELECT *  FROM sk_activity WHERE ";


        //homepage - citizen
        if (array_key_exists('citizen_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_001','activity_002', 'activity_011', 'activity_012', 'activity_021', 'activity_031', 'activity_041', 'activity_051') ";
        }

        //homepage - identification
        if (array_key_exists('identification_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_071') ";
        }

        //homepage - contests
        if (array_key_exists('contests_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_061','activity_062') ";
        }


        //main_locations
        if (array_key_exists('locations_home', $parameters)) {
            $sql = $sql . "spot_id is not null and spot_id <> 0 ";
        }

        //country
        if (array_key_exists('country_id', $parameters)) {

            $em = $this->getDoctrine()->getManager();
            $spots = $em->getRepository('SkaphandrusAppBundle:SkCountry')->getSpots($parameters['country_id']);

            $sql = $sql . "spot_id IN ( ";
            foreach ($spots as $spot) {
                $spots_ids[] = $spot->getId();
            }
            $sql = $sql . implode(',', $spots_ids);
            $sql = $sql . ") ";
        }

        //country
        if (array_key_exists('location_id', $parameters)) {

            $em = $this->getDoctrine()->getManager();
            $spots = $em->getRepository('SkaphandrusAppBundle:SkLocation')->getSpots($parameters['location_id']);

            $sql = $sql . "spot_id IN ( ";
            foreach ($spots as $spot) {
                $spots_ids[] = $spot->getId();
            }
            $sql = $sql . implode(',', $spots_ids);
            $sql = $sql . ") ";
        }

        //spot
        if (array_key_exists('spot_id', $parameters)) {
            $sql = $sql . "spot_id = " . $parameters['spot_id'] . " ";
        }

        //species
        if (array_key_exists('species_id', $parameters)) {
            $sql = $sql . "species_id = " . $parameters['species_id'] . " ";
        }

        //genus
        if (array_key_exists('genus_id', $parameters)) {
            $em = $this->getDoctrine()->getManager();
            $genus = $em->getRepository('SkaphandrusAppBundle:SkGenus')->find($parameters['genus_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($genus->getSpecies() as $species) {
                $species_ids[] = $species->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }


        //family
        if (array_key_exists('family_id', $parameters)) {
            $em = $this->getDoctrine()->getManager();
            $species = $em->getRepository('SkaphandrusAppBundle:SkFamily')->getSpecies($parameters['family_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($species as $sp) {
                $species_ids[] = $sp->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }


        
         //order
        if (array_key_exists('order_id', $parameters)) {
            $em = $this->getDoctrine()->getManager();
            $species = $em->getRepository('SkaphandrusAppBundle:SkOrder')->getSpecies($parameters['order_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($species as $sp) {
                $species_ids[] = $sp->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }

  //class
        if (array_key_exists('class_id', $parameters)) {

            $em = $this->getDoctrine()->getManager();
            $species = $em->getRepository('SkaphandrusAppBundle:SkClass')->getSpecies($parameters['class_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($species as $sp) {
                $species_ids[] = $sp->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }        
        
         //phylum
        if (array_key_exists('phylum_id', $parameters)) {

            $em = $this->getDoctrine()->getManager();
            $species = $em->getRepository('SkaphandrusAppBundle:SkPhylum')->getSpecies($parameters['phylum_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($species as $sp) {
                $species_ids[] = $sp->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }        
        

        
        //kingdom
        if (array_key_exists('kingdom_id', $parameters)) {

            $em = $this->getDoctrine()->getManager();
            $species = $em->getRepository('SkaphandrusAppBundle:SkKingdom')->getSpecies($parameters['kingdom_id']);

            $sql = $sql . "species_id IN ( ";
            foreach ($species as $sp) {
                $species_ids[] = $sp->getId();
            }
            $sql = $sql . implode(',', $species_ids);
            $sql = $sql . ") ";
        }        

        

        $sql = $sql . "ORDER BY " . key($order) . " " . $order[key($order)] . " ";
        $sql = $sql . "LIMIT " . $limit;


//http://stackoverflow.com/questions/8456693/map-array-to-entity-in-symfony2-doctrine2


        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $activities = array();

        foreach ($values as $value) {
            $activity = new \Skaphandrus\AppBundle\Entity\SkActivity();
            $activity->setMessageName($value['message_name']);

            $user_from = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:FosUser')->findOneById($value['user_from']);
            $activity->setUserFrom($user_from);
            $activity->setSpeciesId($value['species_id']);
            $activity->setSpotId($value['spot_id']);
            $activity->setPhotoId($value['photo_id']);
            $activity->setCategoryId($value['category_id']);
            $activity->setCommentId($value['comment_id']);
            $activity->setModuleId($value['module_id']);
            $activity->setUserId($value['user_id']);
            $activity->setCreatedAt($value['created_at']);

            $activities[] = $activity;
        }

//        dump($activities);

        return $this->render('SkaphandrusAppBundle:Common:skActivity.html.twig', array(
                    'activities' => $activities,
        ));
    }

    public function skMessagesAction() {

        $em = $this->getDoctrine()->getManager();
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();

        $message_notifications = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findMessagesFromFosUser($fos_user);
        //$message_unread = 23;


        return $this->render('SkaphandrusAppBundle:Common:skMessages.html.twig', array(
                    'message_notifications' => $message_notifications
        ));
    }

    public function skNotificationsAction() {

        $em = $this->getDoctrine()->getManager();
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();

        $notification_notifications = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findNotificationsFromFosUser($fos_user);
        $notification_unread = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findUnreadNotificationsFromFosUser($fos_user);


        return $this->render('SkaphandrusAppBundle:Common:skNotifications.html.twig', array(
                    'notification_notifications' => $notification_notifications, "notification_unread" => count($notification_unread)
        ));
    }

}
