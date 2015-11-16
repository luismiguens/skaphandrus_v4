<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkSpot
 */
class SkSpot {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $maxDepth;

    /**
     * @var string
     */
    private $coordinate;

    /**
     * @var integer
     */
    private $zoom;

    /**
     * @var boolean
     */
    private $isAproved;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkLocation
     */
    private $location;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;
    private $photosInSpot;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $business;

    public function getPhotosInSpot() {
        return $this->photosInSpot;
    }

    public function setPhotosInSpot($param) {
        $this->photosInSpot = $param;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set maxDepth
     *
     * @param integer $maxDepth
     *
     * @return SkSpot
     */
    public function setMaxDepth($maxDepth) {
        $this->maxDepth = $maxDepth;

        return $this;
    }

    /**
     * Get maxDepth
     *
     * @return integer
     */
    public function getMaxDepth() {
        return $this->maxDepth;
    }

    /**
     * Set coordinate
     *
     * @param string $coordinate
     *
     * @return SkSpot
     */
    public function setCoordinate($coordinate) {
        $this->coordinate = $coordinate;

        return $this;
    }

    /**
     * Get coordinate
     *
     * @return string
     */
    public function getCoordinate() {
        return $this->coordinate;
    }

    /**
     * Set zoom
     *
     * @param integer $zoom
     *
     * @return SkSpot
     */
    public function setZoom($zoom) {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer
     */
    public function getZoom() {
        return $this->zoom;
    }

    /**
     * Set isAproved
     *
     * @param boolean $isAproved
     *
     * @return SkSpot
     */
    public function setIsAproved($isAproved) {
        $this->isAproved = $isAproved;

        return $this;
    }

    /**
     * Get isAproved
     *
     * @return boolean
     */
    public function getIsAproved() {
        return $this->isAproved;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkSpot
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SkSpot
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkSpot
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
     * Set location
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLocation $location
     *
     * @return SkSpot
     */
    public function setLocation(\Skaphandrus\AppBundle\Entity\SkLocation $location = null) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \Skaphandrus\AppBundle\Entity\SkLocation
     */
    public function getLocation() {
        return $this->location;
    }

    public function __toString() {
        return $this->translate()->getName();
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function getDescription() {
        return $this->translate()->getDescription();
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\skPhoto $photo
     *
     * @return SkSpot
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\skPhoto $photo) {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\skPhoto $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\skPhoto $photo) {
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

    public function doStuffOnPreUpdate() {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Add business
     *
     * @param SkBusiness $business
     *
     * @return SkSpot
     */
    public function addBusiness(SkBusiness $business) {
        $this->business[] = $business;

        return $this;
    }

    /**
     * Remove business
     *
     * @param SkBusiness $business
     */
    public function removeBusiness(SkBusiness $business) {
        $this->business->removeElement($business);
    }

    /**
     * Get business
     *
     * @return Collection
     */
    public function getBusiness() {
        return $this->business;
    }

}
