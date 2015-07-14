<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment implements SignedCommentInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="Skaphandrus\AppBundle\Entity\Thread")
     */
    protected $thread;

    /**
     * Author of the comment
     *
     * @var FosUser
     * @ORM\ManyToOne(targetEntity="Skaphandrus\AppBundle\Entity\FosUser")
     */
    protected $author;

    public function setAuthor(UserInterface $author) {
        $this->author = $author;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getAuthorName() {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();




        if (strpos($entity->getThread(), 'SkPhoto') !== false) {

            //enviar notificação ao dono fotografia		
            //(x comentou a tua fotografia y) message_aaa
            $photo_id = substr($entity->getThread(), strpos($entity->getThread(), "-") + 1);
            $skPhoto = $entityManager->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($photo_id);

            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->sendSocialNotifyFromComment(
                    $entity, $skPhoto->getFosUser(), "message_aaa");


            //enviar notificação para quem já comentou fotografia comentada	
            //(x tambem comentou a fotografia y) message_aab
            $query = $entityManager->createQuery(
                            'SELECT c
                                FROM SkaphandrusAppBundle:Comment c
                                WHERE thread_id > :thread_id
                                GROUP BY p.author_id'
                    )->setParameter('thread_id', 'SkPhoto-' . $photo_id);


            //enviar notificação para quem tambem já comentou a fotografia
            //x tambem comentou fotografia y	message_aab
            $comments = $query->getResult();
            foreach ($comments as $comment) {
//                $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->sendSocialNotifyFromComment(
//                        $entity, $comment->getFosUser(), "message_aab");

                if ($entity->getFosUser()->getId() <> $comment->getFosUser()->getId()) {

                    $photo_id = substr($entity->getThread(), strpos($entity->getThread(), "-") + 1);
                    $photo = $entityManager->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($photo_id);

                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getFosUser());
                    $skSocialNotify->setPhoto($photo);
                    $skSocialNotify->setMessageName("message_aab");
                    $skSocialNotify->setCreatedAt(new \DateTime());
                    $skSocialNotify->setUserTo($comment->getFosUser());
                    $entityManager->persist($skSocialNotify);
                    $entityManager->flush();
                }
            }


            //enviar notificação para quem já sugeriu fotografia comentada	
            //(x comentou a fotografia y) message_aac
            $sugestions = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->FindBy(
                    array('photo_id' => $photo_id));

            foreach ($sugestions as $sugestion) {
//                $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->sendSocialNotifyFromComment(
//                        $entity, $photoSpeciesSugestion->getFosUser(), "message_aac");

                if ($entity->getFosUser()->getId() <> $sugestion->getFosUser()->getId()) {

                    $photo_id = substr($entity->getThread(), strpos($entity->getThread(), "-") + 1);
                    $photo = $entityManager->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($photo_id);

                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getFosUser());
                    $skSocialNotify->setPhoto($photo);
                    $skSocialNotify->setMessageName("message_aac");
                    $skSocialNotify->setCreatedAt(new \DateTime());
                    $skSocialNotify->setUserTo($sugestion->getFosUser());
                    $entityManager->persist($skSocialNotify);
                    $entityManager->flush();
                }
            }


            //enviar notificação para quem já validou fotografia comentada	
            //(x comentou a fotografia y) message_aad
            $validations = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->FindBy(
                    array('photo_id' => $photo_id));

            foreach ($validations as $validation) {
//                $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->sendSocialNotifyFromComment(
//                        $entity, $photoSpeciesValidation->getFosUser(), "message_aad");


                if ($entity->getFosUser()->getId() <> $validation->getFosUser()->getId()) {

                    $photo_id = substr($entity->getThread(), strpos($entity->getThread(), "-") + 1);
                    $photo = $entityManager->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($photo_id);

                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getFosUser());
                    $skSocialNotify->setPhoto($photo);
                    $skSocialNotify->setMessageName("message_aad");
                    $skSocialNotify->setCreatedAt(new \DateTime());
                    $skSocialNotify->setUserTo($validation->getFosUser());
                    $entityManager->persist($skSocialNotify);
                    $entityManager->flush();
                }
            }
        }
    }

}
