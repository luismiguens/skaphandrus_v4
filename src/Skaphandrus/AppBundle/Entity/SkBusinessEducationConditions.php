<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessEducationConditions
 */
class SkBusinessEducationConditions {

    /**
     * @var boolean
     */
    private $swimmingpool;

    /**
     * @var boolean
     */
    private $separateclassroom;

    /**
     * @var boolean
     */
    private $singleeducation;

    /**
     * @var integer
     */
    private $maxgroupsize;

    /**
     * @var string
     */
    private $observations;

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
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set swimmingpool
     *
     * @param boolean $swimmingpool
     *
     * @return SkBusinessEducationConditions
     */
    public function setSwimmingpool($swimmingpool) {
        $this->swimmingpool = $swimmingpool;

        return $this;
    }

    /**
     * Get swimmingpool
     *
     * @return boolean
     */
    public function getSwimmingpool() {
        return $this->swimmingpool;
    }

    /**
     * Set separateclassroom
     *
     * @param boolean $separateclassroom
     *
     * @return SkBusinessEducationConditions
     */
    public function setSeparateclassroom($separateclassroom) {
        $this->separateclassroom = $separateclassroom;

        return $this;
    }

    /**
     * Get separateclassroom
     *
     * @return boolean
     */
    public function getSeparateclassroom() {
        return $this->separateclassroom;
    }

    /**
     * Set singleeducation
     *
     * @param boolean $singleeducation
     *
     * @return SkBusinessEducationConditions
     */
    public function setSingleeducation($singleeducation) {
        $this->singleeducation = $singleeducation;

        return $this;
    }

    /**
     * Get singleeducation
     *
     * @return boolean
     */
    public function getSingleeducation() {
        return $this->singleeducation;
    }

    /**
     * Set maxgroupsize
     *
     * @param integer $maxgroupsize
     *
     * @return SkBusinessEducationConditions
     */
    public function setMaxgroupsize($maxgroupsize) {
        $this->maxgroupsize = $maxgroupsize;

        return $this;
    }

    /**
     * Get maxgroupsize
     *
     * @return integer
     */
    public function getMaxgroupsize() {
        return $this->maxgroupsize;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkBusinessEducationConditions
     */
    public function setObservations($observations) {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations() {
        return $this->observations;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkBusinessEducationConditions
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
     * @return SkBusinessEducationConditions
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

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessEducationConditions
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null) {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness() {
        return $this->business;
    }

}
