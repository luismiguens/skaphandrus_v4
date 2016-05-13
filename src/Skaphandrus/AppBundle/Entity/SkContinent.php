<?php

namespace Skaphandrus\AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkContinent
 */
class SkContinent {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $countries;

    /**
     * Constructor
     */
    public function __construct() {
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set countries
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCountry $countries
     *
     * @return SkCountry
     */
    public function setCountries($countries) {
        $this->countries = $countries;

        return $this;
    }

    /**
     * Add countries
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCountry $countries
     *
     * @return SkCountry
     */
    public function addCountries(\Skaphandrus\AppBundle\Entity\SkCountry $countries) {
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCountry $countries
     */
    public function removeCountries(\Skaphandrus\AppBundle\Entity\SkCountry $countries) {
        $this->countries->removeElement($countries);
    }

    /**
     * Get countriess
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries() {
        return $this->countries;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function __toString() {
        return $this->getName();
    }

}
