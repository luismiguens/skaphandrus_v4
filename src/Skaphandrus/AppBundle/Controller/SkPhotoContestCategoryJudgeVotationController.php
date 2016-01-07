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
class SkPhotoContestCategoryJudgeVotationController extends Controller {

    /**
     * Lists all SkPhotoContestCategoryJudgeVotation entities.
     *
     */
    public function index2Action() {

//        $contest_id = 2;
//        $em = $this->getDoctrine()->getManager();
//
//        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
//        $judge = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestJudge')->findOneBy(array('fosUser' => $fos_user));
//
//        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgeVotationsByContest($contest_id, $judge);
//
//        //se ainda não existirem votacoes do juiz criar
//        if (!$entities) {
//
//            $categories = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findBy(array('contest' => $contest_id));
//
//            foreach ($categories as $key => $category) {
//                $JudgeVotation = new SkPhotoContestCategoryJudgeVotation();
//                $JudgeVotation->setCategory($category);
//                $JudgeVotation->setJudge($judge);
//
//                $em->persist($JudgeVotation);
//                $em->flush();
//            }
//
//            $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgeVotationsByContest($contest_id, $judge);
//        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:index2.html.twig', array(
                    'entities' => null,
        ));
    }

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
        
        //ir buscar as categorias do concurso
        $categories = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategory')->findBy(array('contest' => $contest_id));

        foreach ($categories as $key => $category) {

            //para cada categoria verificar se o juiz já votou
            $votation = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgeVotationsByCategory($judge, $category);

            //se não votou criar o registo de votacao da categoria respectiva
            if (!$votation) {

                $JudgeVotation = new SkPhotoContestCategoryJudgeVotation();
                $JudgeVotation->setCategory($category);
                $JudgeVotation->setJudge($judge);
                $em->persist($JudgeVotation);
                $em->flush();
            }
        }

        //ir buscar todas as votações do juiz nas categorias
        $entities = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->getJudgeVotationsByContest($contest_id, $judge);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:index.html.twig', array(
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

        $votation = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);
        $contest = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->findContestByVotation($id);

        if (!$votation) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
        }

        //$entity = new SkPhotoContestCategoryJudgeVotation(); 
        //VERIFICAR SE A VOTACAO JÁ TEM AS FOTOGRAFIAS
        //se o concurso já tiver terminado cria as votacoes para as fotografias mais votadas        
        if (count($votation->getJudgeVote()) < 1):

            $mostVotedPhotos = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->findMostVotedPhotosByCategory($votation->getCategory()->getId());

            foreach ($mostVotedPhotos as $key => $photo) {

//                echo $photo['id']." : ";
//                echo $photo['countable']."<br/>";

                $judgeVote = new \Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgePhotoVote();
                $p = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($photo['id']);
                $p->setPoints($photo['countable']);

                $judgeVote->setPhoto($p);
                $judgeVote->setVotation($votation);
                $judgeVote->setPoints(0);

                $votation->addJudgeVote($judgeVote);
                $em->persist($votation);
            }
            $em->flush();

        else:

            foreach ($votation->getJudgeVote() as $key => $judgeVote) {
                $points = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->countPointsFromPublicInCategory($judgeVote->getPhoto()->getId(), $votation->getCategory()->getId());
                $judgeVote->getPhoto()->setPoints($points);
            }

        endif;

        $editForm = $this->createEditForm($votation);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:edit.html.twig', array(
                    'contest' => $contest,
                    'votation' => $votation,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SkPhotoContestCategoryJudgeVotation entity.
     *
     * @param SkPhotoContestCategoryJudgeVotation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SkPhotoContestCategoryJudgeVotation $entity) {
        $form = $this->createForm(new SkPhotoContestCategoryJudgeVotationType(), $entity, array(
            'action' => $this->generateUrl('judge_votation_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'form.common.btn.update', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Edits an existing SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'form.common.message.changes_saved');
            return $this->redirect($this->generateUrl('judge_votation_admin_edit', array('id' => $id)));
        }

        return $this->render('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SkPhotoContestCategoryJudgeVotation entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkPhotoContestCategoryJudgeVotation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkPhotoContestCategoryJudgeVotation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('judge_votation_admin'));
    }

    /**
     * Creates a form to delete a SkPhotoContestCategoryJudgeVotation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('judge_votation_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'form.common.btn.delete', 'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
