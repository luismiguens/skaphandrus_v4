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
            
            $photo_id = substr($entity->getThread(), strpos($entity->getThread(), "-") + 1);
            $skPhoto = $entityManager->getRepository('SkaphandrusAppBundle:SkPhoto')->findOneById($photo_id);
            
            
            
            
            //enviar notificação ao dono fotografia		
            //(x comentou a tua fotografia y) message_aaa
            if ($entity->getAuthor()->getId() <> $skPhoto->getFosUser()->getId()) {
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getAuthor());
                $skSocialNotify->setPhoto($skPhoto);
                $skSocialNotify->setMessageName("message_aaa");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($skPhoto->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }





            //enviar notificação para quem já comentou fotografia comentada	
            //(x tambem comentou a fotografia y) message_aab
            $query = $entityManager->createQuery(
                            'SELECT c
                                FROM SkaphandrusAppBundle:Comment c
                                WHERE c.thread = :thread_id
                                GROUP BY c.author'
                    )->setParameter('thread_id', 'SkPhoto-' . $photo_id);

            $comments = $query->getResult();
            foreach ($comments as $comment) {
                if ($entity->getAuthor()->getId() <> $comment->getAuthor()->getId()) {
                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getAuthor());
                    $skSocialNotify->setPhoto($photo);
                    $skSocialNotify->setMessageName("message_aab");
                    $skSocialNotify->setCreatedAt(new \DateTime());
                    $skSocialNotify->setUserTo($comment->getAuthor());
                    $entityManager->persist($skSocialNotify);
                    $entityManager->flush();
                }
            }


            //enviar notificação para quem já sugeriu fotografia comentada	
            //(x comentou a fotografia y) message_aac
            $sugestions = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->FindBy(
                    array('photo' => $photo_id));

            foreach ($sugestions as $sugestion) {
                if ($entity->getAuthor()->getId() <> $sugestion->getFosUser()->getId()) {
                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getAuthor());
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
                    array('photo' => $photo_id));

            foreach ($validations as $validation) {
                if ($entity->getAuthor()->getId() <> $validation->getFosUser()->getId()) {
                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getAuthor());
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
