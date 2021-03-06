<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessUnit
 */
class SkBusinessUnit {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitTemperature
     */
    private $temperature;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitVolume
     */
    private $volume;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitWeight
     */
    private $weight;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitPressure
     */
    private $pressure;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitLength
     */
    private $length;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitCapacity
     */
    private $capacity;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitCurrency
     */
    private $currency;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkUnitVelocity
     */
    private $velocity;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set temperature
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitTemperature $temperature
     *
     * @return SkBusinessUnit
     */
    public function setTemperature(\Skaphandrus\AppBundle\Entity\SkUnitTemperature $temperature = null) {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitTemperature
     */
    public function getTemperature() {
        return $this->temperature;
    }

    /**
     * Set volume
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitVolume $volume
     *
     * @return SkBusinessUnit
     */
    public function setVolume(\Skaphandrus\AppBundle\Entity\SkUnitVolume $volume = null) {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitVolume
     */
    public function getVolume() {
        return $this->volume;
    }

    /**
     * Set weight
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitWeight $weight
     *
     * @return SkBusinessUnit
     */
    public function setWeight(\Skaphandrus\AppBundle\Entity\SkUnitWeight $weight = null) {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitWeight
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Set pressure
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitPressure $pressure
     *
     * @return SkBusinessUnit
     */
    public function setPressure(\Skaphandrus\AppBundle\Entity\SkUnitPressure $pressure = null) {
        $this->pressure = $pressure;

        return $this;
    }

    /**
     * Get pressure
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitPressure
     */
    public function getPressure() {
        return $this->pressure;
    }

    /**
     * Set length
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitLength $length
     *
     * @return SkBusinessUnit
     */
    public function setLength(\Skaphandrus\AppBundle\Entity\SkUnitLength $length = null) {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitLength
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessUnit
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
     * Set capacity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitCapacity $capacity
     *
     * @return SkBusinessUnit
     */
    public function setCapacity(\Skaphandrus\AppBundle\Entity\SkUnitCapacity $capacity = null) {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitCapacity
     */
    public function getCapacity() {
        return $this->capacity;
    }

    /**
     * Set currency
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitCurrency $currency
     *
     * @return SkBusinessUnit
     */
    public function setCurrency(\Skaphandrus\AppBundle\Entity\SkUnitCurrency $currency = null) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitCurrency
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Set velocity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkUnitVelocity $velocity
     *
     * @return SkBusinessUnit
     */
    public function setVelocity(\Skaphandrus\AppBundle\Entity\SkUnitVelocity $velocity = null) {
        $this->velocity = $velocity;

        return $this;
    }

    /**
     * Get velocity
     *
     * @return \Skaphandrus\AppBundle\Entity\SkUnitVelocity
     */
    public function getVelocity() {
        return $this->velocity;
    }

}
