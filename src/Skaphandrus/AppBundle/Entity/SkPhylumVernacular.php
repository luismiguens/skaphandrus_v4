<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhylumVernacular
 */
class SkPhylumVernacular
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
     * @var \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    private $phylum;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkPhylumVernacular
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
     * @return SkPhylumVernacular
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
     * Set phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkPhylumVernacular
     */
    public function setPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum = null)
    {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    public function getPhylum()
    {
        return $this->phylum;
    }
}

