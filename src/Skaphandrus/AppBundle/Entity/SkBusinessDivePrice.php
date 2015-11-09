<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessDivePrice
 */
class SkBusinessDivePrice
{
    /**
     * @var integer
     */
    private $numberofdives;

    /**
     * @var integer
     */
    private $valueperdives;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;


    /**
     * Set numberofdives
     *
     * @param integer $numberofdives
     *
     * @return SkBusinessDivePrice
     */
    public function setNumberofdives($numberofdives)
    {
        $this->numberofdives = $numberofdives;

        return $this;
    }

    /**
     * Get numberofdives
     *
     * @return integer
     */
    public function getNumberofdives()
    {
        return $this->numberofdives;
    }

    /**
     * Set valueperdives
     *
     * @param integer $valueperdives
     *
     * @return SkBusinessDivePrice
     */
    public function setValueperdives($valueperdives)
    {
        $this->valueperdives = $valueperdives;

        return $this;
    }

    /**
     * Get valueperdives
     *
     * @return integer
     */
    public function getValueperdives()
    {
        return $this->valueperdives;
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
     * @return SkBusinessDivePrice
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

