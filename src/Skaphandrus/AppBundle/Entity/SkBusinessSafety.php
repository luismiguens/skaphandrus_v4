<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessSafety
 */
class SkBusinessSafety
{
    /**
     * @var boolean
     */
    private $oxigen;

    /**
     * @var boolean
     */
    private $firstaidkit;

    /**
     * @var \DateTime
     */
    private $hourstohospital;

    /**
     * @var \DateTime
     */
    private $hourstodecochamber;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;


    /**
     * Set oxigen
     *
     * @param boolean $oxigen
     *
     * @return SkBusinessSafety
     */
    public function setOxigen($oxigen)
    {
        $this->oxigen = $oxigen;

        return $this;
    }

    /**
     * Get oxigen
     *
     * @return boolean
     */
    public function getOxigen()
    {
        return $this->oxigen;
    }

    /**
     * Set firstaidkit
     *
     * @param boolean $firstaidkit
     *
     * @return SkBusinessSafety
     */
    public function setFirstaidkit($firstaidkit)
    {
        $this->firstaidkit = $firstaidkit;

        return $this;
    }

    /**
     * Get firstaidkit
     *
     * @return boolean
     */
    public function getFirstaidkit()
    {
        return $this->firstaidkit;
    }

    /**
     * Set hourstohospital
     *
     * @param \DateTime $hourstohospital
     *
     * @return SkBusinessSafety
     */
    public function setHourstohospital($hourstohospital)
    {
        $this->hourstohospital = $hourstohospital;

        return $this;
    }

    /**
     * Get hourstohospital
     *
     * @return \DateTime
     */
    public function getHourstohospital()
    {
        return $this->hourstohospital;
    }

    /**
     * Set hourstodecochamber
     *
     * @param \DateTime $hourstodecochamber
     *
     * @return SkBusinessSafety
     */
    public function setHourstodecochamber($hourstodecochamber)
    {
        $this->hourstodecochamber = $hourstodecochamber;

        return $this;
    }

    /**
     * Get hourstodecochamber
     *
     * @return \DateTime
     */
    public function getHourstodecochamber()
    {
        return $this->hourstodecochamber;
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
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessSafety
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness()
    {
        return $this->business;
    }
}

