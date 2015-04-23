<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkCountryTranslation
 */
class SkCountryTranslation
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $overview;

    /**
     * @var string
     */
    private $geographyAndClimate;

    /**
     * @var string
     */
    private $entryRequirements;

    /**
     * @var string
     */
    private $healthAndSafety;

    /**
     * @var string
     */
    private $timeZone;

    /**
     * @var string
     */
    private $communications;

    /**
     * @var string
     */
    private $powerAndElectricity;

    /**
     * @var string
     */
    private $otherInformations;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkCountry
     */
    private $translatable;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkCountryTranslation
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
     * Set overview
     *
     * @param string $overview
     *
     * @return SkCountryTranslation
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set geographyAndClimate
     *
     * @param string $geographyAndClimate
     *
     * @return SkCountryTranslation
     */
    public function setGeographyAndClimate($geographyAndClimate)
    {
        $this->geographyAndClimate = $geographyAndClimate;

        return $this;
    }

    /**
     * Get geographyAndClimate
     *
     * @return string
     */
    public function getGeographyAndClimate()
    {
        return $this->geographyAndClimate;
    }

    /**
     * Set entryRequirements
     *
     * @param string $entryRequirements
     *
     * @return SkCountryTranslation
     */
    public function setEntryRequirements($entryRequirements)
    {
        $this->entryRequirements = $entryRequirements;

        return $this;
    }

    /**
     * Get entryRequirements
     *
     * @return string
     */
    public function getEntryRequirements()
    {
        return $this->entryRequirements;
    }

    /**
     * Set healthAndSafety
     *
     * @param string $healthAndSafety
     *
     * @return SkCountryTranslation
     */
    public function setHealthAndSafety($healthAndSafety)
    {
        $this->healthAndSafety = $healthAndSafety;

        return $this;
    }

    /**
     * Get healthAndSafety
     *
     * @return string
     */
    public function getHealthAndSafety()
    {
        return $this->healthAndSafety;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     *
     * @return SkCountryTranslation
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set communications
     *
     * @param string $communications
     *
     * @return SkCountryTranslation
     */
    public function setCommunications($communications)
    {
        $this->communications = $communications;

        return $this;
    }

    /**
     * Get communications
     *
     * @return string
     */
    public function getCommunications()
    {
        return $this->communications;
    }

    /**
     * Set powerAndElectricity
     *
     * @param string $powerAndElectricity
     *
     * @return SkCountryTranslation
     */
    public function setPowerAndElectricity($powerAndElectricity)
    {
        $this->powerAndElectricity = $powerAndElectricity;

        return $this;
    }

    /**
     * Get powerAndElectricity
     *
     * @return string
     */
    public function getPowerAndElectricity()
    {
        return $this->powerAndElectricity;
    }

    /**
     * Set otherInformations
     *
     * @param string $otherInformations
     *
     * @return SkCountryTranslation
     */
    public function setOtherInformations($otherInformations)
    {
        $this->otherInformations = $otherInformations;

        return $this;
    }

    /**
     * Get otherInformations
     *
     * @return string
     */
    public function getOtherInformations()
    {
        return $this->otherInformations;
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
     * @param \Skaphandrus\AppBundle\Entity\SkCountry $translatable
     *
     * @return SkCountryTranslation
     */
    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkCountry $translatable = null)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * Get translatable
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCountry
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}

