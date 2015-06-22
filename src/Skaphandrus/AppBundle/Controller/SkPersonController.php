<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkPerson;
use Skaphandrus\AppBundle\Form\SkPersonType;

/**
 * SkPerson controller.
 *
 */
class SkPersonController extends Controller
{

    /**
     * Lists all SkPerson entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        ##@LM
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('SkaphandrusAppBundle:SkPerson')->findByFosUser($fos_user );


        return $this->render('SkaphandrusAppBundle:SkPerson:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkPerson entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkPerson();
        
        ##@LM
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $entity->setFosUser($fos_user);
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');

            return $this->redirect($this->generateUrl('person_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPerson entity.
     *
     * @param SkPerson $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPerson $entity)
    {
        $form = $this->createForm(new SkPersonType(), $entity, array(
            'action' => $this->generateUrl('person_admin_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPerson entity.
     *
     */
    public function newAction()
    {
        $entity = new SkPerson();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPerson entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkPerson')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkPerson entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkPerson:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkPerson entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPerson entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkPerson entity.
    *
    * @param SkPerson $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkPerson $entity)
    {
        $form = $this->createForm(new SkPersonType(), $entity, array(
            'action' => $this->generateUrl('person_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
//@LM
//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkPerson entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

                        ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            
            return $this->redirect($this->generateUrl('person_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkPerson entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPerson')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPerson entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('person_admin'));
    }

    /**
     * Creates a form to delete a SkPerson entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
