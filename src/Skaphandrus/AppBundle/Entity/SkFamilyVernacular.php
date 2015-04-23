<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkFamilyVernacular
 */
class SkFamilyVernacular
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkFamily
     */
    private $family;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkFamilyVernacular
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
     * Set name
     *
     * @param string $name
     *
     * @return SkFamilyVernacular
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkFamilyVernacular
     */
    public function setFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family = null)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \Skaphandrus\AppBundle\Entity\SkFamily
     */
    public function getFamily()
    {
        return $this->family;
    }
}

