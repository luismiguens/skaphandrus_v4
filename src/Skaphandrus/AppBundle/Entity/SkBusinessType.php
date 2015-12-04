<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkBusinessType
 */
class SkBusinessType {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $business;

    /**
     * Constructor
     */
    public function __construct() {
        $this->business = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessType
     */
    public function addBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
        $this->business[] = $business;

        return $this;
    }

    /**
     * Remove business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     */
    public function removeBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
        $this->business->removeElement($business);
    }

    /**
     * Get business
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBusiness() {
        return $this->business;
    }

    public function getName() {
        return $this->__toString();
    }

    public function __toString() {
        return $this->translate()->getName();
    }

}
