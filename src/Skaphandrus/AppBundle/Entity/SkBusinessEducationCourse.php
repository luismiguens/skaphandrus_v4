<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessEducationCourse
 */
class SkBusinessEducationCourse {

    /**
     * @var integer
     */
    private $price;

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
     * @var \Skaphandrus\AppBundle\Entity\SkCourse
     */
    private $course;

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return SkBusinessEducationCourse
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkBusinessEducationCourse
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
     * @return SkBusinessEducationCourse
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
     * @return SkBusinessEducationCourse
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

    /**
     * Set course
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCourse $course
     *
     * @return SkBusinessEducationCourse
     */
    public function setCourse(\Skaphandrus\AppBundle\Entity\SkCourse $course = null) {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCourse
     */
    public function getCourse() {
        return $this->course;
    }

}
