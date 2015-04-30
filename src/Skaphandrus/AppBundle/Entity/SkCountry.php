<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCountry
 */
class SkCountry
{

    use ORMBehaviors\Translatable\Translatable;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $regions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Add region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     *
     * @return SkCountry
     */
    public function addRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region)
    {
        $this->regions[] = $region;

        return $this;
    }

    /**
     * Remove region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     */
    public function removeRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region)
    {
        $this->regions->removeElement($region);
    }

    /**
     * Get regions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegions()
    {
        return $this->regions;
    }
}
