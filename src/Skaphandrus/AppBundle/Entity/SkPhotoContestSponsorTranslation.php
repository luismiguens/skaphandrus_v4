<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestSponsorTranslation
 */
class SkPhotoContestSponsorTranslation
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor
     */
    private $translatable;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkPhotoContestSponsorTranslation
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
     * Set locale
     *
     * @param string $locale
     *
     * @return SkPhotoContestSponsorTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $translatable
     *
     * @return SkPhotoContestSponsorTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

