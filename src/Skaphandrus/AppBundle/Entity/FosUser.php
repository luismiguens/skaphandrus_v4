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



class FosUser extends BaseUser implements \Symfony\Component\Security\Core\Encoder\EncoderAwareInterface{


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
    private $modules;


    private $personal;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photosValidated;


    public function getEncoderName() {
        return $this->algorithm == 'sha1' ? 'legacy' : 'default';
    }

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }


    
   public function getPersonal()
    {
        return $this->personal;
    }
    
     
    //@@@@@@@@@ TEMPORARY APENAS PARA IMPORTACAO DOS UTILIZADORES
    /** 
     * Set id
     *
     * @return integer 
     */
    public function setPersonalId($personal)
    {
        $this->personal = $personal;
        
        return $this;
    }
    
    
    
    /**
     * Set algorithm
     *
     * @param string $algorithm
     * @return User
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return string 
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
     
    //@@@@@@@@@ TEMPORARY APENAS PARA IMPORTACAO DOS UTILIZADORES
    /** 
     * Set id
     *
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    //@@@@@@@@@ TEMPORARY APENAS PARA IMPORTACAO DOS UTILIZADORES
    
    
    /**
     * Add spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return FosUser
     */
    public function addSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot)
    {
        $this->spots[] = $spot;

        return $this;
    }

    /**
     * Remove spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     */
    public function removeSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot)
    {
        $this->spots->removeElement($spot);
    }

    /**
     * Get spots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpots()
    {
        return $this->spots;
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return FosUser
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add photosValidated
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated
     *
     * @return FosUser
     */
    public function addPhotosValidated(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated)
    {
        $this->photosValidated[] = $photosValidated;

        return $this;
    }

    
      /**
     * Remove $photosValidated
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated
     */
    public function removePhotosValidated(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photosValidated)
    {
        $this->photosValidated->removeElement($photosValidated);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotosValidated()
    {
        return $this->photosValidated;
    }
    
    
    
    
    
    
    /**
     * Remove module
     *
     * @param \Skaphandrus\AppBundle\Entity\SkModule $module
     */
    public function removeModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }
    
    
       public function addModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module)
    {
        $this->modules[] = $module;

        return $this;
    }
    
    
    public function getName(){
       return $this->getPersonal()->__toString();
    }
            
    
    public function __toString() {
        return $this->getName();
    }
    
    
    
    
    
}
