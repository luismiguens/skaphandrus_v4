<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkKingdomVernacular
 */
class SkKingdomVernacular
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
     * @var \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    private $kingdom;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkKingdomVernacular
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
     * @return SkKingdomVernacular
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
     * Set kingdom
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdom $kingdom
     *
     * @return SkKingdomVernacular
     */
    public function setKingdom(\Skaphandrus\AppBundle\Entity\SkKingdom $kingdom = null)
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    /**
     * Get kingdom
     *
     * @return \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    public function getKingdom()
    {
        return $this->kingdom;
    }
}

