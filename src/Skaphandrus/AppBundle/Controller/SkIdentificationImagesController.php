<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * SkIdentificationImages controller.
 *
 */
class SkIdentificationImagesController extends Controller
{

    /**
     * Lists all SkIdentificationImages entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $group_id = $request->get("group_id");

        // Get current group
        //$group = new SkIdentificationGroup();
        $group = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->findOneById($group_id);

        // Get all groups for filter
        $groups = $em->getRepository('SkaphandrusAppBundle:SkIdentificationGroup')->findBy(array('isParentModule' => true));
        
        
        //dump($groups);
        

//        $params = array();
//
//        $params[$group->getTaxonName()] = $group->getTaxonValue()->getId();
//        $params['group_id'] = $group_id;

    
        $criterias = $group->getCriterias();
        
        
        
        

        // parameters to template
        return $this->render('SkaphandrusAppBundle:SkIdentificationImages:index.html.twig', array(
                   
                   'criterias' => $criterias,
                    'groups' => $groups,
                    'group' => $group, 
        ));
    }
}
