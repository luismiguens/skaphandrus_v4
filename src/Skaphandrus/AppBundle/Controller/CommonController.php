<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class CommonController extends Controller {

    
    /*
     * Prints the activity feed
     *
     * Include these files on the page:
     
     */

    public function skActivityAction($parameters, $limit = 20, $order = array('createdAt' => 'desc')) {

        $qb = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkActivity')->getQueryBuilder($parameters, $limit, $order);
        $query = $qb->getQuery();

        $activities = $query->getResult();

        return $this->render('SkaphandrusAppBundle:Common:skActivity.html.twig', array(
                    'activities' => $activities,
        ));
    }
    
    
    
    
    

}
