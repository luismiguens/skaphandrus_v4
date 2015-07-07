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

        if (array_key_exists('citizen_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_001','activity_002', 'activity_011', 'activity_012', 'activity_021', 'activity_031', 'activity_041', 'activity_051') ";
        }

        if (array_key_exists('identification_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_071') ";
        }

        if (array_key_exists('contests_activity', $parameters)) {
            $sql = $sql . "message_name in ('activity_061','activity_062') ";
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

}
