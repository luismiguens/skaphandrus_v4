<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skaphandrus\AppBundle\Entity\SkUserPoints;
use Skaphandrus\AppBundle\Form\SkUserPointsType;

/**
 * SkUserPoints controller.
 *
 */
class SkUserPointsController extends Controller
{

    /**
     * Lists all SkUserPoints entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->findAll();
        
         $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        
        /********** ESPECIES **********/
        //1ª fotografia associada (e validada) de espécie (campo created_at + 3 validações)(5 PONTOS)
        
        $photos = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->findFirstPhotosFromSpecies($fos_user->getId());
        
        //fotografia de espécie(associada + validada) (campo especie_id + 3 validações)(4 PONTOS)
        
        //fotografia de espécie (associada) (campo especie_id ) (3 PONTOS)
        
        //100 espécies diferentes (associadas e validadas) (10 PONTOS)
        
        
        /********** SPOTS **********/
        //1ª fotografia associada de spot (5 PONTOS)
        
        //fotografia de spot(associada) (3 PONTOS)
        
        //100 fotografias de spots diferentes (associadas) (10 PONTOS)
        
        
        
        /********** FOTOGRAFIAS **********/
        
        //fotografia submetida (1 PONTO)
        
        
        //fotografia com 10 likes (5 PONTOS)
        
        
        //fotografia em concurso (5 PONTOS  )
        
        
        
        /**** UTILIZADOR *****/
        //registo de utilizador (50 PONTOS)
        
        
        
        

        return $this->render('SkaphandrusAppBundle:SkUserPoints:index.html.twig', array(
            'entities' => $photos,
        ));
    }
    /**
     * Creates a new SkUserPoints entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SkUserPoints();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('points_admin_show', array('id' => $entity->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkUserPoints:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkUserPoints entity.
     *
     * @param SkUserPoints $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SkUserPoints $entity)
    {
        $form = $this->createForm(new SkUserPointsType(), $entity, array(
            'action' => $this->generateUrl('points_admin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkUserPoints entity.
     *
     */
    public function newAction()
    {
        $entity = new SkUserPoints();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkUserPoints:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SkUserPoints entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkUserPoints entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkUserPoints:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SkUserPoints entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkUserPoints entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkUserPoints:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SkUserPoints entity.
    *
    * @param SkUserPoints $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SkUserPoints $entity)
    {
        $form = $this->createForm(new SkUserPointsType(), $entity, array(
            'action' => $this->generateUrl('points_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SkUserPoints entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkUserPoints entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('points_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkUserPoints:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SkUserPoints entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkUserPoints')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkUserPoints entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('points_admin'));
    }

    /**
     * Creates a form to delete a SkUserPoints entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('points_admin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
