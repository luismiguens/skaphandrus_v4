<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Intl\Intl;

/**
 * SkCurrency
 */
class SkCurrency
{
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
    public function __construct()
    {
        $this->business = new ArrayCollection();
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return SkCurrency
     */
    public function setName($currency)
    {
        $this->name = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString() {
        return Intl::getCurrencyBundle()->getCurrencyName($this->name)." ".Intl::getCurrencyBundle()->getCurrencySymbol($this->name);
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

    /**
     * Add business
     *
     * @param SkBusiness $business
     *
     * @return SkCurrency
     */
    public function addBusiness(SkBusiness $business)
    {
        $this->business[] = $business;

        return $this;
    }

    /**
     * Remove business
     *
     * @param SkBusiness $business
     */
    public function removeBusiness(SkBusiness $business)
    {
        $this->business->removeElement($business);
    }

    /**
     * Get business
     *
     * @return Collection
     */
    public function getBusiness()
    {
        return $this->business;
    }
}
