<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkSpecies;
use Skaphandrus\AppBundle\Form\SkIdentificationSpeciesType;

/**
 * SkSpecies controller.
 *
 */
class SkIdentificationSpeciesController extends Controller
{

    /**
     * Lists all SkSpecies entities.
     *
     */
    public function indexAction($module_id)
    {

        $em = $this->getDoctrine()->getManager();

        $module = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findOneById($module_id);

        $entities = array();
        foreach ($module->getGroups() as $group) {
            $entities = array_merge($entities, $group->getTaxonValue()->getSpecies()->toArray());
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SkSpecies entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkSpecies();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('identification_species_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkSpecies entity.
     *
     * @param SkSpecies $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkSpecies $entity)
    {
        $form = $this->createForm(new SkSpeciesType(), $entity, array(
            'action' => $this->generateUrl('identification_species_admin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkSpecies entity.
     *
     */
    public function newAction()
    {
        $entity = new SkSpecies();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkSpecies entity.
     *
     */
    // public function showAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find SkSpecies entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return $this->render('SkaphandrusAppBundle:SkSpecies:show.html.twig', array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    /**
     * Displays a form to edit an existing SkSpecies entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSpecies entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkSpecies entity.
    *
    * @param SkSpecies $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkSpecies $entity)
    {
        $form = $this->createForm(new SkIdentificationSpeciesType(), $entity, array(
            'action' => $this->generateUrl('identification_species_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkSpecies entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkSpecies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('identification_species_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkSpecies entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkSpecies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('identification_species_admin'));
    }

    /**
     * Creates a form to delete a SkSpecies entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('identification_species_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
