<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkRegion
 */
class SkRegion
{

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkCountry
     */
    private $country;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $locations;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add location
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLocation $location
     *
     * @return SkRegion
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
