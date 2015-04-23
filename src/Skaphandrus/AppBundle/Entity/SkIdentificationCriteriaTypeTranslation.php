<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationCriteriaTypeTranslation
 */
class SkIdentificationCriteriaTypeTranslation
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
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType
     */
    private $translatable;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkIdentificationCriteriaTypeTranslation
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
     * @return SkIdentificationCriteriaTypeTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType $translatable
     *
     * @return SkIdentificationCriteriaTypeTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

