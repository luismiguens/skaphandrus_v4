<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoSpeciesValidation
 */
class SkPhotoSpeciesValidation {

    /**
     * @var integer
     */
    private $rating;

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
     * Set rating
     *
     * @param integer $rating
     *
     * @return SkPhotoSpeciesValidation
     */
    public function setRating($rating) {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating() {
        return $this->rating;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoSpeciesValidation
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
     * @return SkPhotoSpeciesValidation
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
     * @return SkPhotoSpeciesValidation
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
     * @return SkPhotoSpeciesValidation
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
        //(x validou especie y na fotografia z message_caa
        $sugestions = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesSugestion')->FindBy(
                array('photo' => $entity->getPhoto()->getId()));

        foreach ($sugestions as $sugestion) {
//            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesValidation(
//                    $entity, $photoSpeciesSugestion->getFosUser(), "message_caa");

            if ($entity->getFosUser()->getId() <> $sugestion->getFosUser()->getId()) {
                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getFosUser());
                $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                $skSocialNotify->setPhoto($entity->getPhoto());
                $skSocialNotify->setMessageName("message_caa");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($sugestion->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }


        //enviar notificação para quem já validou	
        //(x validou especie y na fotografia z message_cab
        $validations = $entityManager->getRepository('SkaphandrusAppBundle:SkPhotoSpeciesValidation')->FindBy(
                array('photo' => $entity->getPhoto()->getId()));

        foreach ($validations as $validation) {
//            $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesValidation(
//                    $entity, $photoSpeciesValidation->getFosUser(), "message_cab");

            if ($entity->getFosUser()->getId() <> $validation->getFosUser()->getId()) {
                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getFosUser());
                $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                $skSocialNotify->setPhoto($entity->getPhoto());
                $skSocialNotify->setMessageName("message_cab");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($validation->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }


        //enviar notificação para o dono fotografia 
        //(x validou especie y na tua fotografia z message_cac
//        $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhotoSpeciesValidation(
//                $entity, $entity->getPhoto()->getFosUser(), "message_cac");

        if ($entity->getFosUser()->getId() <> $entity->getPhoto()->getFosUser()->getId()) {
            //$entityManager = $this->getEntityManager();
            $skSocialNotify = new SkSocialNotify();
            $skSocialNotify->setUserFrom($entity->getFosUser());
            $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
            $skSocialNotify->setPhoto($entity->getPhoto());
            $skSocialNotify->setMessageName("message_cac");
            $skSocialNotify->setCreatedAt(new \DateTime());
            $skSocialNotify->setUserTo($entity->getPhoto()->getFosUser());
            $entityManager->persist($skSocialNotify);
            $entityManager->flush();
        }



        //atribuir este rating na fotografia.
        //$entity = new SkPhotoSpeciesValidation();
        //$photo = new SkPhoto();
        $photo = $entity->getPhoto();
        $photo->setValidatedRating($entity->getRating());
        $entityManager->persist($photo);
        $entityManager->flush();



        
        
        //query to update all:
        //UPDATE sk_photo TableB 
        //SET TableB.validated_rating = (
        //SELECT TableA.media 
        //FROM (select photo_id, floor(avg(rating)) media from sk_photo_species_validation group by photo_id) TableA
        //WHERE TableA.photo_id = TableB.id
        //);
        
        //TODO
        // condição: se existirem tres validações com a mesma especie
        // atribuição 1) sk_photo.species_id = a especie com tres validações
        // atribuição 2) sk_photo.is_validated = true
        // atribuição 3) sk_photo.validated_rating = media das tres validacoes

    }

}
