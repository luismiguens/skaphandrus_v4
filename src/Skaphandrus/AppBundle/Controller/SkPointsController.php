<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkPoints;
use Skaphandrus\AppBundle\Form\SkPointsType;

/**
 * SkPoints controller.
 *
 */
class SkPointsController extends Controller {

    /**
     * Lists all SkPoints entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('SkaphandrusAppBundle:SkPoints');
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();



//submited photos
        $photos_submited = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->findBy(array('fosUser' => $fos_user->getId()));

        //first photo about species
        $first_photo_species = $repository->findFirstPhotosFromSpecies($fos_user->getId()); //(min created_at)
        //photos with validated species
        $validated_species = $repository->findValidatedSpeciesPhotos($fos_user->getId()); //(is_validated=true)
        //photos with associated species
        $associated_species = $repository->findAssociatedSpeciesPhotos($fos_user->getId()); //(species_id <> null)
//photos with validated species

        $distinct_validated = $repository->findDistictValidatedSpeciesPhotos($fos_user->getId());


        $ten_distinct_species_validated = 0;
        $hundred_distinct_species_validated = 0;
        $thousand_distinct_species_validated = 0;

        if (count($distinct_validated) > 9) {
            $ten_distinct_species_validated = 1;
        }
        if (count($distinct_validated) > 99) {
            $hundred_distinct_species_validated = 1;
        }

        if (count($distinct_validated) > 999) {
            $thousand_distinct_species_validated = 1;
        }

//sugested species by user
        $user_sugestions = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->findBy(array('fosUser' => $fos_user->getId()));

        $ten_user_species_sugestions = 0;
        $hundred_user_species_sugestions = 0;
        $thousand_user_species_sugestions = 0;


        if (count($user_sugestions) > 9) {
            $ten_user_species_sugestions = 1;
        }
        if (count($user_sugestions) > 99) {
            $hundred_user_species_sugestions = 1;
        }

        if (count($user_sugestions) > 999) {
            $thousand_user_species_sugestions = 1;
        }

//validated species by user
        $user_validations = $em->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->findBy(array('fosUser' => $fos_user->getId()));
        $ten_user_species_validations = 0;
        $hundred_user_species_validations = 0;
        $thousand_user_species_validations = 0;

        if (count($user_validations) > 9) {
            $ten_user_species_validations = 1;
        }
        if (count($user_validations) > 99) {
            $hundred_user_species_validations = 1;
        }

        if (count($user_validations) > 999) {
            $thousand_user_species_validations = 1;
        }

        //first photo in spot
        $first_photo_spot = $repository->findFirstPhotosFromSpot($fos_user->getId());

        //photos associted to spot
        $associated_spot = $repository->findAssociatedSpotsPhotos($fos_user->getId());


        $arr = array(
            1 => array("type" => "user_register", "single" => 50, "number" => 1),
            2 => array("type" => "(photos)_photos_submited", "single" => 1, "number" => count($photos_submited)),
            3 => array("type" => "(photos)_first_photo_species", "single" => 5, "number" => count($first_photo_species)),
            4 => array("type" => "(photos)_validated_species", "single" => 1, "number" => count($validated_species)),
            5 => array("type" => "(photos)_associated_species", "single" => 1, "number" => count($associated_species)),
            6 => array("type" => "(species)_1_distinct_species_validated", "single" => 1, "number" => count($distinct_validated)),
            7 => array("type" => "(species)_10_distinct_species_validated", "single" => 10, "number" => $ten_distinct_species_validated),
            8 => array("type" => "(species)_100_distinct_species_validated", "single" => 100, "number" => $hundred_distinct_species_validated),
            9 => array("type" => "(species)_1000_distinct_species_validated", "single" => 1000, "number" => $thousand_distinct_species_validated),
            10 => array("type" => "(photos)_first_photo_spot", "single" => 5, "number" => count($first_photo_spot)),
            11 => array("type" => "(photos)_associated_spot", "single" => 1, "number" => count($associated_spot)),
            12 => array("type" => "(photos)_1_user_species_sugestions", "single" => 1, "number" => count($user_sugestions)),
            13 => array("type" => "(photos)_10_user_species_sugestions", "single" => 10, "number" => $ten_user_species_sugestions),
            14 => array("type" => "(photos)_100_user_species_sugestions", "single" => 100, "number" => $hundred_user_species_sugestions),
            15 => array("type" => "(photos)_1000_user_species_sugestions", "single" => 1000, "number" => $thousand_user_species_sugestions),
            16 => array("type" => "user_expert", "single" => 50, "number" => 1),
            17 => array("type" => "(photos)_1_user_species_validations", "single" => 1, "number" => count($user_validations)),
            18 => array("type" => "(photos)_10_user_species_validations", "single" => 10, "number" => $ten_user_species_validations),
            19 => array("type" => "(photos)_100_user_species_validations", "single" => 100, "number" => $hundred_user_species_validations),
            20 => array("type" => "(photos)_1000_user_species_validations", "single" => 1000, "number" => $thousand_user_species_validations),
        );






        $SkPointsTypes = $em->getRepository('SkaphandrusAppBundle:SkPointsType')->findAll();
        $total_points = 0;

        foreach ($SkPointsTypes as $key => $SkPointsType) {

            $skPoints = $repository->findOneBy(array('fosUser' => $fos_user->getId(), 'pointsType' => $SkPointsType->getId()));

            if (!$skPoints) {
                $skPoints = new SkPoints();
                $skPoints->setFosUser($fos_user);
                $skPoints->setPointsType($SkPointsType);
            }


            $SkPointsType->translate('pt')->setName($arr[$key + 1]['type']);
            $SkPointsType->translate('en')->setName($arr[$key + 1]['type']);
            $em->persist($SkPointsType);


            $skPoints->setPoints(($arr[$key + 1]['single'] * $arr[$key + 1]['number']));
            //$skPoints->setPoints($arr[$key + 1]['single'] * 0);
            $em->persist($skPoints);
            
            $total_points = $total_points + $skPoints->getPoints();
        }

        
        
        
        $em->flush();
        $entities = $em->getRepository('SkaphandrusAppBundle:SkPoints')->findAll();

        
        //update username points
//        $SkUsername = $em->getRepository('SkaphandrusAppBundle:SkUsername')->findOneBy(array('fosUser' => $fos_user->getId()));
//        $SkUsername->setPoints($total_points);
        
        

        return $this->render('SkaphandrusAppBundle:SkPoints:index.html.twig', array(
                    'entities' => $entities,
                    'arr' => $arr,
            'total_points' => $total_points 
        ));
    }

    /**
     * Creates a new SkPoints entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new SkPoints();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('points_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkPoints:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkPoints entity.
     *
     * @param SkPoints $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkPoints $entity) {
        $form = $this->createForm(new SkPointsType(), $entity, array(
            'action' => $this->generateUrl('points_admin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkPoints entity.
     *
     */
    public function newAction() {
        $entity = new SkPoints();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkPoints:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkPoints entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPoints entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPoints:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkPoints entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPoints entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPoints:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkPoints entity.
     *
     * @param SkPoints $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkPoints $entity) {
        $form = $this->createForm(new SkPointsType(), $entity, array(
            'action' => $this->generateUrl('points_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing SkPoints entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPoints entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('points_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPoints:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkPoints entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPoints')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPoints entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('points_admin'));
    }

    /**
     * Creates a form to delete a SkPoints entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('points_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
