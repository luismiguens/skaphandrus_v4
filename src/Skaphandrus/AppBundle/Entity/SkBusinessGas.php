<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessGas
 */
class SkBusinessGas {

    /**
     * @var boolean
     */
    private $atmosphericair;

    /**
     * @var boolean
     */
    private $nitrox;

    /**
     * @var boolean
     */
    private $trimix;

    /**
     * @var integer
     */
    private $id;

//    /**
//     * @var \Skaphandrus\AppBundle\Entity\SkBusinessBoat
//     */
//    private $businessboat;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * Set atmosphericair
     *
     * @param boolean $atmosphericair
     *
     * @return SkBusinessGas
     */
    public function setAtmosphericair($atmosphericair) {
        $this->atmosphericair = $atmosphericair;

        return $this;
    }

    /**
     * Get atmosphericair
     *
     * @return boolean
     */
    public function getAtmosphericair() {
        return $this->atmosphericair;
    }

    /**
     * Set nitrox
     *
     * @param boolean $nitrox
     *
     * @return SkBusinessGas
     */
    public function setNitrox($nitrox) {
        $this->nitrox = $nitrox;

        return $this;
    }

    /**
     * Get nitrox
     *
     * @return boolean
     */
    public function getNitrox() {
        return $this->nitrox;
    }

    /**
     * Set trimix
     *
     * @param boolean $trimix
     *
     * @return SkBusinessGas
     */
    public function setTrimix($trimix) {
        $this->trimix = $trimix;

        return $this;
    }

    /**
     * Get trimix
     *
     * @return boolean
     */
    public function getTrimix() {
        return $this->trimix;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

//    /**
//     * Set businessboat
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkBusinessBoat $businessboat
//     *
//     * @return SkBusinessGas
//     */
//    public function setBusinessboat(\Skaphandrus\AppBundle\Entity\SkBusinessBoat $businessboat = null)
//    {
//        $this->businessboat = $businessboat;
//
//        return $this;
//    }
//
//    /**
//     * Get businessboat
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkBusinessBoat
//     */
//    public function getBusinessboat()
//    {
//        return $this->businessboat;
//    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessGas
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
