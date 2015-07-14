<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoSpeciesSugestion
 */
class SkPhotoSpeciesSugestion {

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser() {
        return $this->fosUser;
    }

    /**
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species = null) {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getSpecies() {
        return $this->species;
    }

    /**
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoSpeciesSugestion
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo = null) {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getPhoto() {
        return $this->photo;
    }

    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();


        //enviar notificação para quem já sugeriu 
        //(x sugeriu especie y na fotografia z) message_aba
        $sugestions = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->FindBy(
                array('photo' => $entity->getPhoto()->getId()));

        foreach ($sugestions as $sugestion) {
//            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesSugestion(
//                    $entity, $photoSpeciesSugestion->getFosUser(), "message_aba");


            if ($entity->getFosUser()->getId() <> $sugestion->getFosUser()->getId()) {

                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getFosUser());
                $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                $skSocialNotify->setPhoto($entity->getPhoto());
                $skSocialNotify->setMessageName("message_aba");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($sugestion->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }


        //enviar notificação para quem já validou	
        //(x sugeriu especie y na fotografia z) message_abb
        $validations = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->FindBy(
                array('photo' => $entity->getPhoto()->getId()));

        foreach ($validations as $validation) {
//            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesSugestion(
//                    $entity, $photoSpeciesValidation->getFosUser(), "message_abb");


            if ($entity->getFosUser()->getId() <> $validation->getFosUser()->getId()) {

                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getFosUser());
                $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                $skSocialNotify->setPhoto($entity->getPhoto());
                $skSocialNotify->setMessageName("message_abb");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($validation->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }


        //enviar notificação para o dono fotografia 
        //(x sugeriu especie y na tua fotografia z ) message_abc
//        $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesSugestion(
//                $entity, $entity->getPhoto()->getFosUser(), "message_abc");


        if ($entity->getFosUser()->getId() <> $entity->getPhoto()->getFosUser()->getId()) {

            //$entityManager = $this->getEntityManager();
            $skSocialNotify = new SkSocialNotify();
            $skSocialNotify->setUserFrom($entity->getFosUser());
            $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
            $skSocialNotify->setPhoto($entity->getPhoto());
            $skSocialNotify->setMessageName("message_abc");
            $skSocialNotify->setCreatedAt(new \DateTime());
            $skSocialNotify->setUserTo($entity->getPhoto()->getFosUser());
            $entityManager->persist($skSocialNotify);
            $entityManager->flush();
        }
    }

}
