<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkSpot;
use Skaphandrus\AppBundle\Form\SkSpotType;

/**
 * SkSpot controller.
 *
 */
class SkSpotController extends Controller
{

    /**
     * Lists all SkSpot entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        ##@LM
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkSpot')->findByFosUser($fos_user );

        return $this->render('SkaphandrusAppBundle:SkSpot:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkSpot entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkSpot();
        
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
            
            return $this->redirect($this->generateUrl('spot_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkSpot:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkSpot entity.
     *
     * @param SkSpot $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkSpot $entity)
    {
        $form = $this->createForm(new SkSpotType(), $entity, array(
            'action' => $this->generateUrl('spot_admin_create'),
            'method' => 'POST',
        ));
         
        ##@LM
        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkSpot entity.
     *
     */
    public function newAction()
    {
        $entity = new SkSpot();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkSpot:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkSpot entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkSpot entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkSpot:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkSpot entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSpot entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkSpot:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkSpot entity.
    *
    * @param SkSpot $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkSpot $entity)
    {
        $form = $this->createForm(new SkSpotType(), $entity, array(
            'action' => $this->generateUrl('spot_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        ##@LM
        ##$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkSpot entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSpot entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            ##@LM
            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('spot_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkSpot:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkSpot entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkSpot entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('spot'));
    }

    /**
     * Creates a form to delete a SkSpot entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spot_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
