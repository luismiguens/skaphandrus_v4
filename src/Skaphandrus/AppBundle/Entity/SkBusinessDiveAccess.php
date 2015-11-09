<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessDiveAccess
 */
class SkBusinessDiveAccess {
    /**
     * @var boolean
     */
    private $daydiveboat;

    /**
     * @var boolean
     */
    private $shoredive;

    /**
     * @var boolean
     */
    private $nightdive;

    /**
     * @var boolean
     */
    private $housereef;

    /**
     * @var boolean
     */
    private $daytours;

    /**
     * @var boolean
     */
    private $halfdaytours;

    /**
     * @var boolean
     */
    private $unguideddives;

    /**
     * @var integer
     */
    private $perdaydives;

    /**
     * @var integer
     */
    private $maxdepthdives;

    /**
     * @var integer
     */
    private $maxminutesdives;

    /**
     * @var integer
     */
    private $maxpersonsperdive;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;


    /**
     * Set daydiveboat
     *
     * @param boolean $daydiveboat
     *
     * @return SkBusinessDiveAccess
     */
    public function setDaydiveboat($daydiveboat)
    {
        $this->daydiveboat = $daydiveboat;

        return $this;
    }

    /**
     * Get daydiveboat
     *
     * @return boolean
     */
    public function getDaydiveboat()
    {
        return $this->daydiveboat;
    }

    /**
     * Set shoredive
     *
     * @param boolean $shoredive
     *
     * @return SkBusinessDiveAccess
     */
    public function setShoredive($shoredive)
    {
        $this->shoredive = $shoredive;

        return $this;
    }

    /**
     * Get shoredive
     *
     * @return boolean
     */
    public function getShoredive()
    {
        return $this->shoredive;
    }

    /**
     * Set nightdive
     *
     * @param boolean $nightdive
     *
     * @return SkBusinessDiveAccess
     */
    public function setNightdive($nightdive)
    {
        $this->nightdive = $nightdive;

        return $this;
    }

    /**
     * Get nightdive
     *
     * @return boolean
     */
    public function getNightdive()
    {
        return $this->nightdive;
    }

    /**
     * Set housereef
     *
     * @param boolean $housereef
     *
     * @return SkBusinessDiveAccess
     */
    public function setHousereef($housereef)
    {
        $this->housereef = $housereef;

        return $this;
    }

    /**
     * Get housereef
     *
     * @return boolean
     */
    public function getHousereef()
    {
        return $this->housereef;
    }

    /**
     * Set daytours
     *
     * @param boolean $daytours
     *
     * @return SkBusinessDiveAccess
     */
    public function setDaytours($daytours)
    {
        $this->daytours = $daytours;

        return $this;
    }

    /**
     * Get daytours
     *
     * @return boolean
     */
    public function getDaytours()
    {
        return $this->daytours;
    }

    /**
     * Set halfdaytours
     *
     * @param boolean $halfdaytours
     *
     * @return SkBusinessDiveAccess
     */
    public function setHalfdaytours($halfdaytours)
    {
        $this->halfdaytours = $halfdaytours;

        return $this;
    }

    /**
     * Get halfdaytours
     *
     * @return boolean
     */
    public function getHalfdaytours()
    {
        return $this->halfdaytours;
    }

    /**
     * Set unguideddives
     *
     * @param boolean $unguideddives
     *
     * @return SkBusinessDiveAccess
     */
    public function setUnguideddives($unguideddives)
    {
        $this->unguideddives = $unguideddives;

        return $this;
    }

    /**
     * Get unguideddives
     *
     * @return boolean
     */
    public function getUnguideddives()
    {
        return $this->unguideddives;
    }

    /**
     * Set perdaydives
     *
     * @param integer $perdaydives
     *
     * @return SkBusinessDiveAccess
     */
    public function setPerdaydives($perdaydives)
    {
        $this->perdaydives = $perdaydives;

        return $this;
    }

    /**
     * Get perdaydives
     *
     * @return integer
     */
    public function getPerdaydives()
    {
        return $this->perdaydives;
    }

    /**
     * Set maxdepthdives
     *
     * @param integer $maxdepthdives
     *
     * @return SkBusinessDiveAccess
     */
    public function setMaxdepthdives($maxdepthdives)
    {
        $this->maxdepthdives = $maxdepthdives;

        return $this;
    }

    /**
     * Get maxdepthdives
     *
     * @return integer
     */
    public function getMaxdepthdives()
    {
        return $this->maxdepthdives;
    }

    /**
     * Set maxminutesdives
     *
     * @param integer $maxminutesdives
     *
     * @return SkBusinessDiveAccess
     */
    public function setMaxminutesdives($maxminutesdives)
    {
        $this->maxminutesdives = $maxminutesdives;

        return $this;
    }

    /**
     * Get maxminutesdives
     *
     * @return integer
     */
    public function getMaxminutesdives()
    {
        return $this->maxminutesdives;
    }

    /**
     * Set maxpersonsperdive
     *
     * @param integer $maxpersonsperdive
     *
     * @return SkBusinessDiveAccess
     */
    public function setMaxpersonsperdive($maxpersonsperdive)
    {
        $this->maxpersonsperdive = $maxpersonsperdive;

        return $this;
    }

    /**
     * Get maxpersonsperdive
     *
     * @return integer
     */
    public function getMaxpersonsperdive()
    {
        return $this->maxpersonsperdive;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkBusinessDiveAccess
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
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
     * @return SkBusinessDiveAccess
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

