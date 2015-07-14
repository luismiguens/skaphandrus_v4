<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * @ORM\Entity
 */
class FosMessage extends BaseMessage {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="Skaphandrus\AppBundle\Entity\Thread",
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="Skaphandrus\AppBundle\Entity\FosUser")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="Skaphandrus\AppBundle\Entity\FosMessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|\Doctrine\Common\Collections\Collection
     */
    protected $metadata;

    /**
     * Add metadatum
     *
     * @param \Skaphandrus\AppBundle\Entity\FosMessageMetadata $metadatum
     *
     * @return FosMessage
     */
    public function addMetadatum(\Skaphandrus\AppBundle\Entity\FosMessageMetadata $metadatum) {
        $this->metadata[] = $metadatum;

        return $this;
    }

    /**
     * Remove metadatum
     *
     * @param \Skaphandrus\AppBundle\Entity\FosMessageMetadata $metadatum
     */
    public function removeMetadatum(\Skaphandrus\AppBundle\Entity\FosMessageMetadata $metadatum) {
        $this->metadata->removeElement($metadatum);
    }

    /**
     * Get metadata
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMetadata() {
        return $this->metadata;
    }

    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {

        //$entity = new FosMessage();
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        //enviar notificação para o destinatário da mensagem 		
        //(x enviou-te uma nova mensagem) message_aca
//        $query = $entityManager->createQuery(
//                        'SELECT p
//                                FROM SkaphandrusAppBundle:FosMessageMetadata p
//                                WHERE message_id > :message_id'
//                )->setParameter('message_id', $entity->getId());
//        $messages = $query->getResult();
//        $messages = $entityManager->getRepository('SkaphandrusAppBundle:FosMessageMetadata')->findBy(
//                array('message_id' => $entity->getId()));

        $messages = $entity->getThread()->getParticipants();


//dump($messages);
        //$fosMessageMetadata = new FosMessageMetadata();


        foreach ($messages as $participant) {
//            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->sendSocialNotifyFromFosMessage(
//                    $entity, $participants, "message_aca");

            if ($entity->getSender()->getId() <> $participant->getId()) {

                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getSender());
                $skSocialNotify->setMessage($entity);
                $skSocialNotify->setMessageName("message_aca");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($participant);
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }
    }

}
