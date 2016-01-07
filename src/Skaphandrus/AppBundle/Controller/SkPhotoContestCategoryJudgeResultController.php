<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation;
use Skaphandrus\AppBundle\Form\SkPhotoContestCategoryJudgeVotationType;

/**
 * SkPhotoContestCategoryJudgeVotation controller.
 *
 */
class SkPhotoContestCategoryJudgeResultController extends Controller {

    /**
     * Lists all SkPhotoContestCategoryJudgeVotation entities.
     *
     */
    public function indexAction(Request $request) {

        $contest_id = $request->query->get('contest_id');
        if (!$contest_id)
            $contest_id = $request->request->get('contest_id');

        $em = $this->getDoctrine()->getManager();

        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        $judge = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->findOneBy(array('fosUser' => $fos_user));

        $contest = $em->getRepository('SkaphandrusAppBundle:SkPhotoContest')->find($contest_id);

        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgeVotationsByContest($contest_id, $judge);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeResult:index.html.twig', array(
                    'entities' => $entities,
                    'contest' => $contest,
        ));
    }

//
//    /**
//     * Creates a new SkPhotoContestCategoryJudgeVotation entity.
//     *
//     */
//    public function createAction(Request $request) {
//        $entity = new SkPhotoContestCategoryJudgeVotation();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('judge_votation_admin_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to create a SkPhotoContestCategoryJudgeVotation entity.
//     *
//     * @param SkPhotoContestCategoryJudgeVotation $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createCreateForm(SkPhotoContestCategoryJudgeVotation $entity) {
//        $form = $this->createForm(new SkPhotoContestCategoryJudgeVotationType(), $entity, array(
//            'action' => $this->generateUrl('judge_votation_admin_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }
//    /**
//     * Displays a form to create a new SkPhotoContestCategoryJudgeVotation entity.
//     *
//     */
//    public function newAction() {
//        $entity = new SkPhotoContestCategoryJudgeVotation();
//        $form = $this->createCreateForm($entity);
//
//        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:new.html.twig', array(
//                    'entity' => $entity,
//                    'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a SkPhotoContestCategoryJudgeVotation entity.
//     *
//     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:show.html.twig', array(
//                    'entity' => $entity,
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $votation = new SkPhotoContestCategoryJudgeVotation();
        $votation = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);


        $contest = $votation->getCategory()->getContest();
//        $contest = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->findContestByVotation($id);

        if (!$votation) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
        }

        $results = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgePhotoVoteResults($votation->getCategory()->getId());



        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeResult:edit.html.twig', array(
                    'contest' => $contest,
                    'votation' => $votation,
                    'results' => $results,
        ));
    }

    /**
     * Creates a form to edit a SkPhotoContestCategoryJudgeVotation entity.
     *
     * @param SkPhotoContestCategoryJudgeVotation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createEditForm(SkPhotoContestCategoryJudgeVotation $entity) {
//        $form = $this->createForm(new SkPhotoContestCategoryJudgeVotationType(), $entity, array(
//            'action' => $this->generateUrl('judge_votation_admin_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        //$form->add('submit', 'submit', array('label' => 'form.common.btn.update', 'attr' => array('class' => 'btn btn-primary')));
//
//        return $form;
//    }

    /**
     * Edits an existing SkPhotoContestCategoryJudgeVotation entity.
     *
     */
//    public function updateAction(Request $request, $id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
//            return $this->redirect($this->generateUrl('judge_votation_admin_edit', array('id' => $id)));
//        }
//
//        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:edit.html.twig', array(
//                    'entity' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Deletes a SkPhotoContestCategoryJudgeVotation entity.
     *
     */
//    public function deleteAction(Request $request, $id) {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('judge_votation_admin'));
//    }

    /**
     * Creates a form to delete a SkPhotoContestCategoryJudgeVotation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm($id) {
//        return $this->createFormBuilder()
//                        ->setAction($this->generateUrl('judge_votation_admin_delete', array('id' => $id)))
//                        ->setMethod('DELETE')
//                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
//                        ->getForm()
//        ;
//    }

}
