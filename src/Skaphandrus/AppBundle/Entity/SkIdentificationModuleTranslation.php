<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationModuleTranslation
 */
class SkIdentificationModuleTranslation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    private $translatable;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkIdentificationModuleTranslation
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
     * Set locale
     *
     * @param string $locale
     *
     * @return SkIdentificationModuleTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationModule $translatable
     *
     * @return SkIdentificationModuleTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

