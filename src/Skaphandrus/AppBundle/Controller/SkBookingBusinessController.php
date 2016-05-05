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
        $loggedUser = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkaphandrusAppBundle:SkBooking')->findBy(array('business' => $request->query->get('id')));

        $business = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($request->query->get('id'));

        if (!$business) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        // verifica se o user é admin e se o user é admin do business
        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser) || $business->isUserAdminFromBusiness($loggedUser)) {

            return $this->render('SkaphandrusAppBundle:SkBookingBusiness:index.html.twig', array(
                        'entities' => $entities,
                        'business' => $business
            ));
        } else {
            throw $this->createAccessDeniedException('Unauthorised access!');
//            return $this->redirect($this->generateUrl('error403'));
//            return $this->render('SkaphandrusAppBundle:Common:error403.html.twig');
        }
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
