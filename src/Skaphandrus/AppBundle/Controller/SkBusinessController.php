<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Form\SkBusinessType;

/**
 * SkBusiness controller.
 *
 */
class SkBusinessController extends Controller {

    /**
     * Create currencies records in table.
     *
     */
    public function createCurrenciesAction() {
        $em = $this->getDoctrine()->getManager();
        $list = array("USD", "EUR", "JPY", "GBP", "AUD", "CHF", "CAD", "MXN", "CNY", "NZD", "SEK", "RUB", "HKD", "NOK", "SGD", "TRY", "KRW", "ZAR", "BRL", "INR");

        foreach ($list as $key => $value) {
            $object = new \Skaphandrus\AppBundle\Entity\SkCurrency();
            $object->setName($value);
            $em->persist($object);
        }
        $em->flush();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkCurrency')->findAll();

        return $this->render('SkaphandrusAppBundle:SkBusiness:createCurrencies.html.twig', array(
                    'entities' => $entities,
        ));
    }
    
        /**
     * Create languages records in table.
     *
     */
    public function createLanguagesAction() {
        $em = $this->getDoctrine()->getManager();
        $list = array("zh", "en", "es", "hi", "bn", "pt", "ru", "fr", "ur", "ja", "de", "ko", "tr", "it", "ar");

        foreach ($list as $key => $value) {
            $object = new \Skaphandrus\AppBundle\Entity\SkLanguage();
            $object->setName($value);
            $em->persist($object);
        }
        $em->flush();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkLanguage')->findAll();

        return $this->render('SkaphandrusAppBundle:SkBusiness:createLanguage.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Lists all SkBusiness entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->get('request')->getLocale();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllBusiness($locale);

        return $this->render('SkaphandrusAppBundle:SkBusiness:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new SkBusiness entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkBusiness();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            
            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkBusiness $entity) {
        $form = $this->createForm(new SkBusinessType(), $entity, array(
            'action' => $this->generateUrl('business_admin_create'),
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
        $entity = new SkBusiness();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkBusiness entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkBusiness:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkBusiness entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkBusiness entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkBusiness:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkBusiness $entity) {
        $form = $this->createForm(new SkBusinessType(), $entity, array(
            'action' => $this->generateUrl('business_admin_update', array('id' => $entity->getId())),
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

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            
            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkBusiness:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkBusiness entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkBusiness entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('business_admin'));
    }

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
