<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkIdentificationCriteria;
use Skaphandrus\AppBundle\Form\SkIdentificationCriteriaType;

/**
 * SkIdentificationCriteria controller.
 *
 */
class SkIdentificationCriteriaController extends Controller
{

    /**
     * Lists all SkIdentificationCriteria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->findAll();

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkIdentificationCriteria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkIdentificationCriteria();
        $form = $this->createCreateForm($entity);
        
        // Set parent ID on embedded forms
        $embedded = $request->request->get('skaphandrus_appbundle_skidentificationcriteria');
        foreach ($embedded['characters'] as &$character) {
            $character['criteria'] = $entity->getId();
        }

        $form->handleRequest($request);

        if ($form->isValid()) {

            foreach($entity->getCharacters() as $character) {
                $character->upload();
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('identification_criteria_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkIdentificationCriteria entity.
     *
     * @param SkIdentificationCriteria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkIdentificationCriteria $entity)
    {
        $form = $this->createForm(new SkIdentificationCriteriaType(), $entity, array(
            'action' => $this->generateUrl('identification_criteria_admin_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkIdentificationCriteria entity.
     *
     */
    public function newAction()
    {
        $entity = new SkIdentificationCriteria();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkIdentificationCriteria entity.
     *
     */
    // public function showAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find SkIdentificationCriteria entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:show.html.twig', array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    /**
     * Displays a form to edit an existing SkIdentificationCriteria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationCriteria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkIdentificationCriteria entity.
    *
    * @param SkIdentificationCriteria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkIdentificationCriteria $entity)
    {
        $form = $this->createForm(new SkIdentificationCriteriaType(), $entity, array(
            'action' => $this->generateUrl('identification_criteria_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkIdentificationCriteria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkIdentificationCriteria entity.');
        }

        // Set parent ID on embedded forms
        $embedded = $request->request->get('skaphandrus_appbundle_skidentificationcriteria');
        foreach ($embedded['characters'] as &$character) {
            $character['criteria'] = $id;
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {
            foreach($entity->getCharacters() as $character) {
                $character->upload();
            }

            $em->flush();

            return $this->redirect($this->generateUrl('identification_criteria_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationCriteria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkIdentificationCriteria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkIdentificationCriteria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('identification_criteria_admin'));
    }

    /**
     * Creates a form to delete a SkIdentificationCriteria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('identification_criteria_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
