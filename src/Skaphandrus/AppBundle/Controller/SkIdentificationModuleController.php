<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkIdentificationModule;
use Skaphandrus\AppBundle\Form\SkIdentificationModuleType;

/**
 * SkIdentificationModule controller.
 *
 */
class SkIdentificationModuleController extends Controller
{

    /**
     * Lists all SkIdentificationModule entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findAll();

        return $this->render('SkaphandrusAppBundle:SkIdentificationModule:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkIdentificationModule entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkIdentificationModule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

//            $entity->upload();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('identification_module_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationModule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkIdentificationModule entity.
     *
     * @param SkIdentificationModule $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkIdentificationModule $entity)
    {
        $form = $this->createForm(new SkIdentificationModuleType(), $entity, array(
            'action' => $this->generateUrl('identification_module_admin_create'),
            'method' => 'POST',
        ));

        // $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkIdentificationModule entity.
     *
     */
    public function newAction()
    {
        $entity = new SkIdentificationModule();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkIdentificationModule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkIdentificationModule entity.
     *
     */
    // public function showAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find SkIdentificationModule entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return $this->render('SkaphandrusAppBundle:SkIdentificationModule:show.html.twig', array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    /**
     * Displays a form to edit an existing SkIdentificationModule entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationModule entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationModule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkIdentificationModule entity.
    *
    * @param SkIdentificationModule $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkIdentificationModule $entity)
    {
        $form = $this->createForm(new SkIdentificationModuleType(), $entity, array(
            'action' => $this->generateUrl('identification_module_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkIdentificationModule entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationModule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
//            $entity->upload();
            
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('identification_module_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationModule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkIdentificationModule entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkIdentificationModule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('identification_module_admin'));
    }

    /**
     * Creates a form to delete a SkIdentificationModule entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('identification_module_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'form.common.btn.delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
