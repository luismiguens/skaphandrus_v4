<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSpeciesTranslation
 */
class SkSpeciesTranslation
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $howToFind;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $translatable;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkSpeciesTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set howToFind
     *
     * @param string $howToFind
     *
     * @return SkSpeciesTranslation
     */
    public function setHowToFind($howToFind)
    {
        $this->howToFind = $howToFind;

        return $this;
    }

    /**
     * Get howToFind
     *
     * @return string
     */
    public function getHowToFind()
    {
        return $this->howToFind;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkSpeciesTranslation
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set translatable
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $translatable
     *
     * @return SkSpeciesTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkSpecies $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

