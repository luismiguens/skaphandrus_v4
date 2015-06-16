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

        /*         * ******** ESPECIES ********* */
        //1ª fotografia associada (e validada) de espécie (campo created_at + 3 validações)(5 PONTOS)

        $points_001 = $repository->findFirstPhotosFromSpecies($fos_user->getId());

        $skPoints_001 = $repository->findOneBy(array('fosUser' => $fos_user->getId(), 'pointsType' => 1));

        if (!$skPoints_001) {
            $skPoints_001 = new SkPoints();
            $skPoints_001->setFosUser($fos_user);
            $skPoints_001->setPointsType($em->getRepository('SkaphandrusAppBundle:SkPointsType')->findOneById(1));
        }

        $skPoints_001->setPoints(count($points_001));

        $em->persist($skPoints_001);
        $em->flush();



        //fotografia de espécie(associada + validada) (campo especie_id + 3 validações)(4 PONTOS)

        $points_002 = $repository->findValidatedSpeciesPhotos($fos_user->getId());




        $skPoints_002 = $repository->findOneBy(array('fosUser' => $fos_user->getId(), 'pointsType' => 2));


        if (!$skPoints_002) {
            $skPoints_002 = new SkPoints();
            $skPoints_002->setFosUser($fos_user);
            $skPoints_002->setPointsType($em->getRepository('SkaphandrusAppBundle:SkPointsType')->findOneById(2));
        }

        $skPoints_002->setPoints(count($points_002));

        $em->persist($skPoints_002);
        $em->flush();


        //fotografia de espécie (associada) (campo especie_id ) (3 PONTOS)
        //100 espécies diferentes (associadas e validadas) (10 PONTOS)


        /*         * ******** SPOTS ********* */
        //1ª fotografia associada de spot (5 PONTOS)
        //fotografia de spot(associada) (3 PONTOS)
        //100 fotografias de spots diferentes (associadas) (10 PONTOS)



        /*         * ******** FOTOGRAFIAS ********* */

        //fotografia submetida (1 PONTO)
        //fotografia com 10 likes (5 PONTOS)
        //fotografia em concurso (5 PONTOS  )



        /*         * ** UTILIZADOR **** */
        //registo de utilizador (50 PONTOS)


        $entities = $em->getRepository('SkaphandrusAppBundle:SkPoints')->findAll();


        return $this->render('SkaphandrusAppBundle:SkPoints:index.html.twig', array(
                    'entities' => $entities,
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
