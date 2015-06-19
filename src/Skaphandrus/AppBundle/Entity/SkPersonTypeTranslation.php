<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPersonTypeTranslation
 */
class SkPersonTypeTranslation
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
     * @var \Skaphandrus\AppBundle\Entity\SkPersonType
     */
    private $translatable;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkPersonTypeTranslation
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
     * @return SkPersonTypeTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkPersonType $translatable
     *
     * @return SkPersonTypeTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkPersonType $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPersonType
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

