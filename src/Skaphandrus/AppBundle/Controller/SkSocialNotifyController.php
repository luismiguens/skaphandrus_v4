<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * SkSocialNotify controller.
 *
 */
class SkSocialNotifyController extends Controller {

    /**
     * Lists all SkSocialNotify entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();

        $entities = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findByUserTo($fos_user, array('id'=>'desc'));

        //$notification = new \Skaphandrus\AppBundle\Entity\SkSocialNotify();

        foreach ($entities as $notification) {

            $notification->setIsRead(true);
            $em->persist($notification);
        }
        $em->flush();
        return $this->render('SkaphandrusAppBundle:SkSocialNotify:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkaphandrusAppBundle:SkSocialNotify')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkSocialNotify entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notify_admin'));
    }

    /**
     * Creates a form to delete a SkSocialNotify entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('notify_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
