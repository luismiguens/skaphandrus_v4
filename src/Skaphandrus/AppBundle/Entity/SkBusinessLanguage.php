<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessLanguage
 */
class SkBusinessLanguage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkLanguage
     */
    private $language;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;


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
     * Set language
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLanguage $language
     *
     * @return SkBusinessLanguage
     */
    public function setLanguage(\Skaphandrus\AppBundle\Entity\SkLanguage $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Skaphandrus\AppBundle\Entity\SkLanguage
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessLanguage
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness()
    {
        return $this->business;
    }
}

