<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkGenusVernacular
 */
class SkGenusVernacular
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
     * @var \Skaphandrus\AppBundle\Entity\SkGenus
     */
    private $genus;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkGenusVernacular
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
     * @return SkGenusVernacular
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
     * Set genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkGenusVernacular
     */
    public function setGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus = null)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return \Skaphandrus\AppBundle\Entity\SkGenus
     */
    public function getGenus()
    {
        return $this->genus;
    }
}

