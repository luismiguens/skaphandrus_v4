<?php

namespace Skaphandrus\AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Form\SkBusinessSpotType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * SkBusiness controller.
 *
 */
class SkBusinessSpotController extends Controller {
    /**
     * Lists all SkBusiness entities.
     *
     */
//    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//        $locale = $this->get('request')->getLocale();
//
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllBusiness($locale);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:index.html.twig', array(
//                    'entities' => $entities,
//        ));
//    }

    /**
     * Creates a new SkBusiness entity.
     *
     */
//    public function createAction(Request $request) {
//        $entity = new SkBusiness();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $entity->getId())));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }

    /**
     * Creates a form to create a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createCreateForm(SkBusiness $entity) {
//        $form = $this->createForm(new SkBusinessType(), $entity, array(
//            'action' => $this->generateUrl('business_admin_create'),
//            'method' => 'POST',
//        ));
//
////        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }

    /**
     * Displays a form to create a new SkBusiness entity.
     *
     */
//    public function newAction() {
//        $entity = new SkBusiness();
//        $form = $this->createCreateForm($entity);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }

    /**
     * Finds and displays a SkBusiness entity.
     *
     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkBusiness:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkBusiness entity.
     *
     */
    public function editAction($id) {

        $loggedUser = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        // verifica se o user é admin ou se o user é admin do business e se ainda é premium ou plus
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser) 
                || ($entity->isUserAdminFromBusiness($loggedUser) and ( ($entity->isPremium() == true) or ( $entity->isPlus() == true)))) {

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('SkaphandrusAppBundle:SkBusinessSpot:edit.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
            // verifica se o user é admin do business e se ainda é premium ou plus
        } else {
//            throw new \PHPCR\AccessDeniedException('Unauthorised access or your business is no longer Premium/Plus!');
//            return $this->redirect($this->generateUrl('error403'));
            return $this->render('SkaphandrusAppBundle:Common:error403.html.twig');
        }
    }

    /**
     * Creates a form to edit a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkBusiness $entity) {
        $form = $this->createForm(new SkBusinessSpotType($entity), $entity, array(
            'action' => $this->generateUrl('business_spot_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkBusiness entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        //$entity = new SkBusiness();
        //http://symfony.com/doc/current/cookbook/form/form_collections.html
        //For deleting prices 
        $originalPrices = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getDivePrice() as $price) {
            $originalPrices->add($price);
        }

        //For deleting equipment
        $originalEquip = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getRentEquipment() as $equip) {
            $originalEquip->add($equip);
        }

        //para funcionar com multiple select checkboxes
        //necessário criar o método clear
        $entity->clearSpots();
        $data = $request->get('skaphandrus_appbundle_skbusiness');
        if (isset($data['spotChoices'])) {
            foreach ($data['spotChoices'] as $id_spot) {
                //$spot = $this->getRepo()->find($id);
                $spot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id_spot);
                $entity->addSpot($spot);
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            // remove the relationship between the Tag and the Task
            foreach ($originalPrices as $price) {
                if (false === $entity->getDivePrice()->contains($price)) {
                    // remove the Task from the Tag
                    $price->getBusiness()->removeDiveProuse($price);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $course->setBusiness(null);
                    // $em->persist($course);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($price);
                }
            }

            // remove the relationship between the Tag and the Task
            foreach ($originalEquip as $equip) {
                if (false === $entity->getRentEquipment()->contains($equip)) {
                    // remove the Task from the Tag
                    $equip->getBusiness()->removeRentEquipment($equip);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $course->setBusiness(null);
                    // $em->persist($course);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($equip);
                }
            }

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('business_spot_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkBusinessSpot:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

//    public function updateAction(Request $request, $id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
//        }
//
//        $originalCourse = new \Doctrine\Common\Collections\ArrayCollection();
//
//        // Create an ArrayCollection of the current Tag objects in the database
//        foreach ($entity->getEducationCourse() as $course) {
//            $originalCourse->add($course);
//        }
//
//        $editForm = $this->createEditForm($entity);
//
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//
//            // remove the relationship between the course and the Task
//            foreach ($originalCourse as $course) {
//                if (false === $entity->getEducationCourse()->contains($course)) {
//                    // remove the Task from the Tag
//                    $course->getBusiness()->removeEducationCourse($course);
//
//                    // if it was a many-to-one relationship, remove the relationship like this
//                    // $course->setBusiness(null);
//                    // $em->persist($course);
//                    // if you wanted to delete the Tag entirely, you can also do that
//                    $em->remove($course);
//                }
//            }
//
//            $em->persist($entity);
//            $em->flush();
//
//            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
//            // redirect back to some edit page
//            return $this->redirect($this->generateUrl('business_education_admin_edit', array('id' => $id)));
//        }
//
//////        $deleteForm = $this->createDeleteForm($id);
////        $editForm = $this->createEditForm($entity);
////        $editForm->handleRequest($request);
////
////        if ($editForm->isValid()) {
////            $em->flush();
////
////            return $this->redirect($this->generateUrl('business_education_admin_edit', array('id' => $id)));
////        }
//
//        return $this->render('SkaphandrusAppBundle:SkBusinessEducation:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
////                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Deletes a SkBusiness entity.
     *
     */
//    public function deleteAction(Request $request, $id) {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find SkBusiness entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('business_admin'));
//    }

    /**
     * Creates a form to delete a SkBusiness entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('business_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
