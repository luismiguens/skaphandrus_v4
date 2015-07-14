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
    public function indexAction(Request $request) {        
        $em = $this->getDoctrine()->getManager();
        
        // Handle module_id for filter
        $module_id = ($request_form = $request->request->get('form')) ?
            $request_form['module_filter_form_id'] : 6;

        // Get current module
        $module = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
            ->findOneById($module_id);

        // Get all modules for filter
        $modules = $em->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
            ->findAll();

        // Create Module filter form
        $modules_choices = array();
        foreach ($modules as $m) {
            $modules_choices[$m->getId()] = $m->translate()->getName();
        }
        $modules_form = $this->createFormBuilder(NULL, array('attr' => array('name' => 'module_filter_form', 'id' => 'module_filter_form')))
            ->setMethod('POST')
            ->add('module_filter_form_id', 'choice', array(
                'choices' => $modules_choices,
                'required' => FALSE,
                'label' => 'Module',
                'data' => $module_id,
            ))
            ->add('Filter', 'submit')
            ->getForm();

        $entities = array();
        foreach ($module->getGroups() as $group) {
            if ($group->getIsParentModule()) {
                $entities = array_merge($entities, $group->getTaxonValue()->getSpecies()->toArray());
            }
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:index.html.twig', array(
            'entities' => $entities,
            'modules_form' => $modules_form->createView(),
        ));
    }
    /**
     * Creates a new SkSpecies entity.
     *
     */
    // public function createAction(Request $request)
    // {
    //     $entity = new SkSpecies();
    //     $form = $this->createCreateForm($entity);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($entity);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('identification_species_admin_edit', array('id' => $entity->getId())));
    //     }

    //     return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:new.html.twig', array(
    //         'entity' => $entity,
    //         'form'   => $form->createView(),
    //     ));
    // }

    /**
     * Creates a form to create a SkSpecies entity.
     *
     * @param SkSpecies $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    // private function createCreateForm(SkSpecies $entity)
    // {
    //     $form = $this->createForm(new SkIdentificationSpeciesType(), $entity, array(
    //         'action' => $this->generateUrl('identification_species_admin_create'),
    //         'method' => 'POST',
    //     ));

    //     // $form->add('submit', 'submit', array('label' => 'Create'));

    //     return $form;
    // }

    /**
     * Displays a form to create a new SkSpecies entity.
     *
     */
    // public function newAction()
    // {
    //     $entity = new SkSpecies();
    //     $form   = $this->createCreateForm($entity);

    //     return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:new.html.twig', array(
    //         'entity' => $entity,
    //         'form'   => $form->createView(),
    //     ));
    // }

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

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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

        // Set parent ID on embedded forms
        $embedded = $request->request->get('skaphandrus_appbundle_skspecies');
        foreach ($embedded['imageRefs'] as &$imageRef) {
            $imageRef['species'] = $id;
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('identification_species_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkIdentificationSpecies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    /**
     * Deletes a SkSpecies entity.
     *
     */
    // public function deleteAction(Request $request, $id)
    // {
    //     $form = $this->createDeleteForm($id);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $entity = $em->getRepository('SkaphandrusAppBundle:SkSpecies')->find($id);

    //         if (!$entity) {
    //             throw $this->createNotFoundException('Unable to find SkSpecies entity.');
    //         }

    //         $em->remove($entity);
    //         $em->flush();
    //     }

    //     return $this->redirect($this->generateUrl('identification_species_admin'));
    // }

    /**
     * Creates a form to delete a SkSpecies entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    // private function createDeleteForm($id)
    // {
    //     return $this->createFormBuilder()
    //         ->setAction($this->generateUrl('identification_species_admin_delete', array('id' => $id)))
    //         ->setMethod('DELETE')
    //         ->add('submit', 'submit', array('label' => 'Delete'))
    //         ->getForm()
    //     ;
    // }
}
