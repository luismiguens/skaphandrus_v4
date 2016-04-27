<?php

namespace Skaphandrus\AppBundle\Controller;

use Skaphandrus\AppBundle\Entity\SkAddress;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Entity\SkBusinessFosUser;
use Skaphandrus\AppBundle\Entity\SkContact;
use Skaphandrus\AppBundle\Form\SkBusinessFosUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SkBusiness controller.
 *
 */
class SkBusinessFosUserController extends Controller {

    public function regionsAction(Request $request) {
        $country_id = $request->get('country_id');

        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('SkaphandrusAppBundle:SkRegion')->findBy(array('country' => $country_id));

        $array = array();
        foreach ($regions as $key => $region):
            $array[$key]['id'] = $region->getId();
            $array[$key]['name'] = $region->getName();
        endforeach;

        return new JsonResponse($array);

    }

    public function locationsAction(Request $request) {
        $region_id = $request->get('region_id');

        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('SkaphandrusAppBundle:SkLocation')->findBy(array('region' => $region_id));


        $array = array();
        foreach ($locations as $key => $location):
            $array[$key]['id'] = $location->getId();
            $array[$key]['name'] = $location->getName();
        endforeach;


        return new JsonResponse($array);
    }

    /**
     * Creates a new SkBusiness entity.
     *
     */
    public function createAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $entity = new SkBusinessFosUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        
            
            //criar utilizar
            $business = new SkBusiness();
            $fos_user = new FosUser();

            
            //autenticar utilizador
            
            
            
            //criar empresa
            
            
            
            //associar empresa ao utilizador
            
            
            
            
            //encaminha para a edição total da empresa
            
            
            
            //enviar email para utilizador com dados de user e da empresa (colocar partnerships@skaphandrus.com em cc)
            
            
            $businessFosUser = new SkBusinessFosUser();
            //$businessFosUser = $form->getData();


            $business->setName($businessFosUser->getBusinessName());


            $contact = new SkContact();
            $contact->setEmail($businessFosUser->getBusinessEmail());
            $business->setContact($contact);


            $address = new SkAddress();
            $address->setLocation($businessFosUser->getBusinessLocation());
            $business->setAddress($address);



            $business->set($businessFosUser->getBusinessName());
            $business->setName($businessFosUser->getBusinessName());



            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkBusiness:newBusinessFosUser.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(SkBusinessFosUser $entity) {
        $form = $this->createForm(new SkBusinessFosUserType(), $entity, array(
            'action' => $this->generateUrl('business_fos_user_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkBusiness entity.
     *
     */
    public function newAction() {

        $entity = new SkBusinessFosUser();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkBusiness:newBusinessFosUser.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

}
