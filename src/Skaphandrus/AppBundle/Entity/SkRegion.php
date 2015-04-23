<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkRegion
 */
class SkRegion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkCountry
     */
    private $country;


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
     * Set country
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCountry $country
     *
     * @return SkRegion
     */
    public function setCountry(\Skaphandrus\AppBundle\Entity\SkCountry $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCountry
     */
    public function getCountry()
    {
        return $this->country;
    }
}

