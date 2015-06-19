<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSpeciesImageRef
 */
class SkSpeciesImageRef
{
    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var boolean
     */
    private $isPrimary = '0';

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $imageSrc;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SkSpeciesImageRef
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isPrimary
     *
     * @param boolean $isPrimary
     *
     * @return SkSpeciesImageRef
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * Get isPrimary
     *
     * @return boolean
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return SkSpeciesImageRef
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set imageSrc
     *
     * @param string $imageSrc
     *
     * @return SkSpeciesImageRef
     */
    public function setImageSrc($imageSrc)
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    /**
     * Get imageSrc
     *
     * @return string
     */
    public function getImageSrc()
    {
        return $this->imageSrc;
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
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkSpeciesImageRef
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species = null)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getSpecies()
    {
        return $this->species;
    }
}

