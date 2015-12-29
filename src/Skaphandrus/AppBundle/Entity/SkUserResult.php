<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkUserResult
 */
class SkUserResult {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $species;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var integer
     */
    private $validation;

    /**
     * @var integer
     */
    private $sugestion;

    /**
     * @var integer
     */
    private $photos;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return SkUserResult
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkUserResult
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set species
     *
     * @param string $species
     *
     * @return SkUserResult
     */
    public function setSpecies($species) {
        $this->species = $species;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getSpecies() {
        return $this->species;
    }

    /**
     * Set photos
     *
     * @param string $photos
     *
     * @return SkUserResult
     */
    public function setPhotos($photos) {
        $this->photo = $photos;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getPhotos() {
        return $this->photos;
    }
    
    /**
     * Set validation
     *
     * @param string $validation
     *
     * @return SkUserResult
     */
    public function setValidation($validation) {
        $this->validation = $validation;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getValidation() {
        return $this->validation;
    }
    
    /**
     * Set sugestion
     *
     * @param string $sugestion
     *
     * @return SkUserResult
     */
    public function setSugestion($sugestion) {
        $this->sugestion = $sugestion;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getSugestion() {
        return $this->sugestion;
    }
    
    /**
     * Set points
     *
     * @param string $points
     *
     * @return SkUserResult
     */
    public function setPoints($points) {
        $this->points = $points;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getPoints() {
        return $this->points;
    }
}
