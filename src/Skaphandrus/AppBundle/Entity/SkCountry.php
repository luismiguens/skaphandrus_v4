<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkCountry
 */
class SkCountry
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fipsCode;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkContinent
     */
    private $continent;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkCountry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fipsCode
     *
     * @param string $fipsCode
     *
     * @return SkCountry
     */
    public function setFipsCode($fipsCode)
    {
        $this->fipsCode = $fipsCode;

        return $this;
    }

    /**
     * Get fipsCode
     *
     * @return string
     */
    public function getFipsCode()
    {
        return $this->fipsCode;
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
     * Set continent
     *
     * @param \Skaphandrus\AppBundle\Entity\SkContinent $continent
     *
     * @return SkCountry
     */
    public function setContinent(\Skaphandrus\AppBundle\Entity\SkContinent $continent = null)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return \Skaphandrus\AppBundle\Entity\SkContinent
     */
    public function getContinent()
    {
        return $this->continent;
    }
}

