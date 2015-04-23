<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSpeciesVernacular
 */
class SkSpeciesVernacular
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkVernacular
     */
    private $vernacular;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkSpeciesVernacular
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkVernacular $vernacular
     *
     * @return SkSpeciesVernacular
     */
    public function setVernacular(\Skaphandrus\AppBundle\Entity\SkVernacular $vernacular)
    {
        $this->vernacular = $vernacular;

        return $this;
    }

    /**
     * Get vernacular
     *
     * @return \Skaphandrus\AppBundle\Entity\SkVernacular
     */
    public function getVernacular()
    {
        return $this->vernacular;
    }

    /**
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkSpeciesVernacular
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species)
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

