<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestTranslation
 */
class SkPhotoContestTranslation
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $rules;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    private $translatable;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkPhotoContestTranslation
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
     * Set rules
     *
     * @param string $rules
     *
     * @return SkPhotoContestTranslation
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get rules
     *
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkPhotoContestTranslation
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
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $translatable
     *
     * @return SkPhotoContestTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkPhotoContest $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

