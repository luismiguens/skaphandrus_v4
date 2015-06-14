<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationModule
 */
class SkIdentificationModule {
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $appstoreId;

    /**
     * @var string
     */
    private $googleplayId;

    /**
     * @var boolean
     */
    private $isActive = '0';

    /**
     * @var boolean
     */
    private $isEnabled = '0';

    /**
     * @var boolean
     */
    private $isFree = '0';

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    private $master;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species;

    
    
    
    
    
    
    /**
     * Set appstoreId
     *
     * @param string $appstoreId
     *
     * @return SkIdentificationModule
     */
    public function setAppstoreId($appstoreId) {
        $this->appstoreId = $appstoreId;

        return $this;
    }

    /**
     * Get appstoreId
     *
     * @return string
     */
    public function getAppstoreId() {
        return $this->appstoreId;
    }

    /**
     * Set googleplayId
     *
     * @param string $googleplayId
     *
     * @return SkIdentificationModule
     */
    public function setGoogleplayId($googleplayId) {
        $this->googleplayId = $googleplayId;

        return $this;
    }

    /**
     * Get googleplayId
     *
     * @return string
     */
    public function getGoogleplayId() {
        return $this->googleplayId;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SkIdentificationModule
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return SkIdentificationModule
     */
    public function setIsEnabled($isEnabled) {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsEnabled() {
        return $this->isEnabled;
    }

    /**
     * Set isFree
     *
     * @param boolean $isFree
     *
     * @return SkIdentificationModule
     */
    public function setIsFree($isFree) {
        $this->isFree = $isFree;

        return $this;
    }

    /**
     * Get isFree
     *
     * @return boolean
     */
    public function getIsFree() {
        return $this->isFree;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkIdentificationModule
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkIdentificationModule
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
     * Set master
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationMaster $master
     *
     * @return SkIdentificationModule
     */
    public function setMaster(\Skaphandrus\AppBundle\Entity\SkIdentificationMaster $master = null) {
        $this->master = $master;

        return $this;
    }

    /**
     * Get master
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    public function getMaster() {
        return $this->master;
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Add group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     *
     * @return FosUser
     */
    public function addGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group) {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     */
    public function removeGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group) {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }

}
