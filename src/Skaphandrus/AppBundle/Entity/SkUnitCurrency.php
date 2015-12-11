<?php

namespace Skaphandrus\AppBundle\Entity;

use Symfony\Component\Intl\Intl;

/**
 * SkUnitCurrency
 */
class SkUnitCurrency {

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set code
     *
     * @param string $code
     *
     * @return SkUnitCurrency
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
//    public function getCode() {
//        return $this->code;
//    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

//    public function __toString() {
//        return $this->getCode();
//    }

    public function getCode() {
        return Intl::getCurrencyBundle()->getCurrencyName($this->code) . " (" . Intl::getCurrencyBundle()->getCurrencySymbol($this->code) . ")";
    }

    public function __toString() {
        return Intl::getCurrencyBundle()->getCurrencyName($this->code) . " (" . Intl::getCurrencyBundle()->getCurrencySymbol($this->code) . ")";
    }

}
