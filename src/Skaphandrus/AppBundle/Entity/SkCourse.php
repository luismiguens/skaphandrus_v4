<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCourse
 */
class SkCourse {

    use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @var string
     */
    private $name;

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
     * @var \Skaphandrus\AppBundle\Entity\SkCourseAffiliation
     */
    private $affiliation;

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkCourse
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkCourse
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
     * @return SkCourse
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
     * Set affiliation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCourseAffiliation $affiliation
     *
     * @return SkCourse
     */
    public function setAffiliation(\Skaphandrus\AppBundle\Entity\SkCourseAffiliation $affiliation = null) {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * Get affiliation
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCourseAffiliation
     */
    public function getAffiliation() {
        return $this->affiliation;
    }

    public function __toString() {
        return $this->getName();
    }

}
