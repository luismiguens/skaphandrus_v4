<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationMasterTranslation
 */
class SkIdentificationMasterTranslation
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
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    private $translatable;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkIdentificationMasterTranslation
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
     * @return SkIdentificationMasterTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationMaster $translatable
     *
     * @return SkIdentificationMasterTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkIdentificationMaster $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

