<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkLocation
 */
class SkLocation {

    use ORMBehaviors\Translatable\Translatable;

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
     * @var \Skaphandrus\AppBundle\Entity\SkRegion
     */
    private $region;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $spots;
    private $spotsCount = 0;
    private $photosCount = 0;
    private $photosInLocation;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkLocation
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
     * @return SkLocation
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
     * Set region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     *
     * @return SkLocation
     */
    public function setRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region = null) {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Skaphandrus\AppBundle\Entity\SkRegion
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->spots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkLocation
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

    public function setSpots($spots) {
        $this->spots = $spots;
    }

    public function __toString() {

        if ($this->getName()):
            return $this->getName();
        else:
            return "BLA";
        endif;
    }

    public function getName() {

        return $this->translate()->getName();
    }

    public function getDescription() {
        return $this->translate()->getDescription();
    }

    public function getWaterTemp() {
        return $this->translate()->getWaterTemp();
    }

    public function getSuit() {
        return $this->translate()->getSuit();
    }

    public function getVisibility() {
        return $this->translate()->getVisibility();
    }

    public function getClimate() {
        return $this->translate()->getClimate();
    }

    public function getHowToGo() {
        return $this->translate()->getHowToGo();
    }

    public function getExtraDive() {
        return $this->translate()->getExtraDive();
    }

    public function getSpotsCount() {
        return $this->spotsCount;
    }

    public function setSpotsCount($spotsCount) {
        $this->spotsCount = $spotsCount;
    }

    public function getPhotosCount() {
        return $this->photosCount;
    }

    public function setPhotosCount($photosCount) {
        $this->photosCount = $photosCount;
    }

    public function getPhotosInLocation() {
        return $this->photosInLocation;
    }

    public function setPhotosInLocation($photosInLocation) {
        $this->photosInLocation = $photosInLocation;
    }

//    public function getLocationName($locale){
//        
//        //$locale = $this->translate()->setLocale($locale);
//        
//        //echo "bla : " . $locale;
//        return $this->translate($locale)->getName();
//        
//      
//        
//    }
}
