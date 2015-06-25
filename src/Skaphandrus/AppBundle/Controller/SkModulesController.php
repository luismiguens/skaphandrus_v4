<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Form\FosUserModulesType;

/**
 * SkModules controller.
 *
 */
class SkModulesController extends Controller {

    /**
     * Displays a form to edit an existing FosUser entity.
     *
     */
    public function editAction() {

        ##@LM
        $entity = $this->get('security.token_storage')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        $editForm = $this->createEditForm($entity);


        //$options = $editForm->get('acquisitions')->getConfig()->getOptions();
        //$choices = $options['choice_list']->getChoices();
        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkModules:edit.html.twig', array(
                    'entity' => $entity,
                    // 'choices' => $choices,
                    'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Creates a form to edit a FosUser entity.
     *
     * @param FosUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(FosUser $entity) {
        $form = $this->createForm(new FosUserModulesType(), $entity, array(
            'action' => $this->generateUrl('module_admin_update'),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing FosUser entity.
     *
     */
//    public function updateAction(Request $request) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $this->get('security.token_storage')->getToken()->getUser();
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find FosUser entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('module_admin_edit'));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkModules:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView()
//        ));
//    }
    // metodo alterado de acordo com os post
    //http://www.prowebdev.us/2012/07/symfnoy2-many-to-many-relation-with.html

    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->get('security.token_storage')->getToken()->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        $editForm = $this->createEditForm($entity);

        $previousCollections = $entity->getAcquisitions();
        $previousCollections = $previousCollections->toArray();

        //$request = $this->getRequest();
        //$editForm->bindRequest($request);

        $editForm->handleRequest($request);

        foreach ($previousCollections as $acquisition) {
            $entity->removeAcquisition($acquisition);
            $em->remove($acquisition); 
            $em->persist($entity);
        }



        if ($editForm->isValid()) {
           
            $em->flush();


            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

//            return $this->redirect($this->generateUrl('module_admin_edit'));
        }

//        return $this->render('SkaphandrusAppBundle:SkModules:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView()
//        ));
    }

}
