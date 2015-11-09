<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessCurrency
 */
class SkBusinessCurrency {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return SkBusinessCurrency
     */
    public function setCurrency($currency) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency() {
        //return $this->currency;
        return array('EUR' => Intl::getCurrencyBundle()->getCurrencyName('INR'));
    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessCurrency
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

}
