<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkBooking;
use Skaphandrus\AppBundle\Form\SkBookingType;

/**
 * SkBooking controller.
 *
 */
class SkBookingBusinessController extends Controller {

    /**
     * Lists all SkBooking entities.
     *
     */
    public function bookingBusinessAction(Request $request) {
        $em = $this->getDoctrine()->getManager();        
        $entities = $em->getRepository('SkaphandrusAppBundle:SkBooking')->findBy(array('business' => $request->query->get('id')));

        return $this->render('SkaphandrusAppBundle:SkBookingBusiness:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a SkBooking entity.
     *
     */
    public function showBookingBusinessAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SkaphandrusAppBundle:SkBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBooking entity.');
        }

        return $this->render('SkaphandrusAppBundle:SkBookingBusiness:show.html.twig', array(
                    'entity' => $entity,
        ));
    }

}
