<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */

namespace Skaphandrus\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use FOS\MessageBundle\Model\ParticipantInterface;



class FosUser extends BaseUser implements EncoderAwareInterface, ParticipantInterface {

    protected $id;
    protected $algorithm = 'sha512';

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $spots;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $acquisitions;
    private $modules;
    
    
    private $personal;
    private $address;
    private $contact;
    private $settings;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photosValidated;

    public function getEncoderName() {
        return $this->algorithm == 'sha1' ? 'legacy' : 'default';
    }

    public function __construct() {
        parent::__construct();
        
        $this->acquisitions = new ArrayCollection();
        $this->modules = new ArrayCollection();
        
        // your own logic
    }

    
    
      // Important 
    public function getModules()
    {
        $modules = new ArrayCollection();
        
        foreach($this->acquisitions as $acquisition)
        {
            $modules[] = $acquisition->getModule();
        }

        return $modules;
    }
    // Important
    public function setModules($modules)
    {
        foreach($modules as $module)
        {
            $acquisition = new SkIdentificationAcquisition();

            $acquisition->setFosUser($this);
            $acquisition->setModule($module);

            $this->addAcquisition($acquisition);
        }

    }
    
    
    
    
    
    
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getSettings() {
        return $this->settings;
    }

    /**
     * Set settings
     *
     * @return integer 
     */
    public function setSettings($settings) {
        $this->settings = $settings;

        return $this;
    }

    public function getPersonal() {
        return $this->personal;
    }

    /**
     * Set personal
     *
     * @return integer 
     */
    public function setPersonal($personal) {
        $this->personal = $personal;

        return $this;
    }

    public function getContact() {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @return integer 
     */
    public function setContact($contact) {
        $this->contact = $contact;

        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    /**
     * Set address
     *
     * @return integer 
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Set algorithm
     *
     * @param string $algorithm
     * @return User
     */
    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return string 
     */
    public function getAlgorithm() {
        return $this->algorithm;
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
     * Set id
     *
     * @return integer 
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Add spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return FosUser
     */
    public function addSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot) {
        $this->spots[] = $spot;

        return $this;
    }

    /**
     * Remove spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     */
    public function removeSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot) {
        $this->spots->removeElement($spot);
    }

    /**
     * Get spots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpots() {
        return $this->spots;
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return FosUser
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos() {
        return $this->photos;
    }

    /**
     * Add photosValidated
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated
     *
     * @return FosUser
     */
    public function addPhotosValidated(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated) {
        $this->photosValidated[] = $photosValidated;

        return $this;
    }

    /**
     * Remove $photosValidated
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated
     */
    public function removePhotosValidated(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated) {
        $this->photosValidated->removeElement($photosValidated);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotosValidated() {
        return $this->photosValidated;
    }

    /**
     * Remove acquisition
     *
     * @param \Skaphandrus\AppBundle\Entity\SkAcquisition $acquisition
     */
    public function removeAcquisition(\Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition) {
        $this->acquisitions->removeElement($acquisition);
    }

    /**
     * Get acquisitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcquisitions() {
        return $this->acquisitions;
    }

    public function addAcquisition(\Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition) {
        $this->acquisitions[] = $acquisition;

        return $this;
    }

    public function getName() {
        return $this->getPersonal()->__toString();
    }

    public function __toString() {
        return $this->getName();
    }

    
    public function getFosUser() {
        return $this;
    }

    
    public function doStuffOnPostLoad(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if (!$entity->getSettings()) {
            $settings = new SkSettings();
            $settings->setFosUser($entity);
            $entity->setSettings($settings);

            $entityManager->persist($settings);
        }
        if (!$entity->getPersonal()) {
            $personal = new SkPersonal();
            $personal->setFosUser($entity);
            $entity->setPersonal($personal);
            
            $entityManager->persist($personal);
        }

        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
