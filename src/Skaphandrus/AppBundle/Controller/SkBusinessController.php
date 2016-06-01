<?php

namespace Skaphandrus\AppBundle\Controller;

use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Form\SkBusinessType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    //registo de uma empresa
    public function sendRegistrationEmail(FosUser $user, SkBusiness $business) {
        $message = \Swift_Message::newInstance()
                ->setSubject("Thanks for registering " . $business->getName())
                ->setFrom('noreply-registration@skaphandrus.com', 'Skaphandrus')
                ->setTo($user->getEmail())
                ->setBcc('partnerships@skaphandrus.com')
                ->setBody(
                $this->renderView(
                        'SkaphandrusAppBundle:SkBusiness:registrationBusiness.html.twig', array(
                    'user' => $user,
                    'business' => $business,
                )), 'text/html'
                )
        ;

        $this->get('mailer')->send($message);
    }

    /**
     * Lists all SkBusiness entities.
     *
     */
    public function indexAction() {

        //$loggedUser = new \Skaphandrus\AppBundle\Entity\FosUser();

        $loggedUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $locale = $this->get('request')->getLocale();

        // verifica se o user é admin
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser)) {
            $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllBusiness($locale, null);
        } else {
            $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllBusiness($locale, $loggedUser->getId());
        }

        return $this->render('SkaphandrusAppBundle:SkBusiness:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function index2Action() {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SkaphandrusAppBundle:SkBusiness')->findAllWithAdmin();

        return $this->render('SkaphandrusAppBundle:SkBusiness:index2.html.twig', array(
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

            $loggedUser = $this->getUser();

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser)) {
                $entity->addAdmin($loggedUser);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //enviar email para utilizador com dados de user e da empresa (colocar partnerships@skaphandrus.com em cc)
            $this->sendRegistrationEmail($loggedUser, $entity);

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

//        $loggedUser = $this->getUser();
//
//        // verifica se o user é admin
//        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser)) {
//            throw $this->createAccessDeniedException('Unauthorised access!');
////            return $this->redirect($this->generateUrl('error403'));
////            return $this->render('SkaphandrusAppBundle:Common:error403.html.twig');
//        } else {
//
//            $entity = new SkBusiness();
//            $form = $this->createCreateForm($entity);
//
//            return $this->render('SkaphandrusAppBundle:SkBusiness:new.html.twig', array(
//                        'entity' => $entity,
//                        'form' => $form->createView(),
//            ));
//        }
    }

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

        // verifica se o user é admin e se o user é admin do business
        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN', $loggedUser) || $entity->isUserAdminFromBusiness($loggedUser)) {

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('SkaphandrusAppBundle:SkBusiness:edit.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        } else {
            throw $this->createAccessDeniedException('Unauthorised access!');
//            return $this->redirect($this->generateUrl('error403'));
//            return $this->render('SkaphandrusAppBundle:Common:error403.html.twig');
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
            $updatedAt = new \DateTime('now');
            $entity->setUpdatedAt($updatedAt);

            $em->flush();

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
