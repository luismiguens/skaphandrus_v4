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
    private $locations;


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
     * Constructor
     */
    public function __construct()
    {
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add location
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLocation $location
     *
     * @return SkCountry
     */
    public function addLocation(\Skaphandrus\AppBundle\Entity\SkLocation $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLocation $location
     */
    public function removeLocation(\Skaphandrus\AppBundle\Entity\SkLocation $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }
}
