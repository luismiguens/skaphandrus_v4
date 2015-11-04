<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Intl\Intl;
use Test\Midgard\CreatePHP\Collection;

/**
 * SkLanguage
 */
class SkLanguage {

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Collection
     */
    private $business;

    /**
     * Constructor
     */
    public function __construct() {
        $this->business = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkLanguage
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return Intl::getLanguageBundle()->getLanguageName($this->name);
    }

    public function __toString() {
        return Intl::getLanguageBundle()->getLanguageName($this->name);
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
     * @param SkBusiness $business
     *
     * @return SkLanguage
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
