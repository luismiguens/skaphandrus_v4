<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCountryTranslation
 */
class SkCountryTranslation {

    use ORMBehaviors\Translatable\Translation;

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
     * Set overview
     *
     * @param string $overview
     *
     * @return SkCountryTranslation
     */
    public function setOverview($overview) {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview() {
        return $this->overview;
    }

    /**
     * Set geographyAndClimate
     *
     * @param string $geographyAndClimate
     *
     * @return SkCountryTranslation
     */
    public function setGeographyAndClimate($geographyAndClimate) {
        $this->geographyAndClimate = $geographyAndClimate;

        return $this;
    }

    /**
     * Get geographyAndClimate
     *
     * @return string
     */
    public function getGeographyAndClimate() {
        return $this->geographyAndClimate;
    }

    /**
     * Set entryRequirements
     *
     * @param string $entryRequirements
     *
     * @return SkCountryTranslation
     */
    public function setEntryRequirements($entryRequirements) {
        $this->entryRequirements = $entryRequirements;

        return $this;
    }

    /**
     * Get entryRequirements
     *
     * @return string
     */
    public function getEntryRequirements() {
        return $this->entryRequirements;
    }

    /**
     * Set healthAndSafety
     *
     * @param string $healthAndSafety
     *
     * @return SkCountryTranslation
     */
    public function setHealthAndSafety($healthAndSafety) {
        $this->healthAndSafety = $healthAndSafety;

        return $this;
    }

    /**
     * Get healthAndSafety
     *
     * @return string
     */
    public function getHealthAndSafety() {
        return $this->healthAndSafety;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     *
     * @return SkCountryTranslation
     */
    public function setTimeZone($timeZone) {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone() {
        return $this->timeZone;
    }

    /**
     * Set communications
     *
     * @param string $communications
     *
     * @return SkCountryTranslation
     */
    public function setCommunications($communications) {
        $this->communications = $communications;

        return $this;
    }

    /**
     * Get communications
     *
     * @return string
     */
    public function getCommunications() {
        return $this->communications;
    }

    /**
     * Set powerAndElectricity
     *
     * @param string $powerAndElectricity
     *
     * @return SkCountryTranslation
     */
    public function setPowerAndElectricity($powerAndElectricity) {
        $this->powerAndElectricity = $powerAndElectricity;

        return $this;
    }

    /**
     * Get powerAndElectricity
     *
     * @return string
     */
    public function getPowerAndElectricity() {
        return $this->powerAndElectricity;
    }

    /**
     * Set otherInformations
     *
     * @param string $otherInformations
     *
     * @return SkCountryTranslation
     */
    public function setOtherInformations($otherInformations) {
        $this->otherInformations = $otherInformations;

        return $this;
    }

    /**
     * Get otherInformations
     *
     * @return string
     */
    public function getOtherInformations() {
        return $this->otherInformations;
    }

}
