<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkUserResult
 */
class SkUserResults {

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
    private $validations;

    /**
     * @var integer
     */
    private $sugestions;

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
    public function setValidations($validations) {
        $this->validations = $validations;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getValidations() {
        return $this->validations;
    }
    
    /**
     * Set sugestion
     *
     * @param string $sugestion
     *
     * @return SkUserResult
     */
    public function setSugestions($sugestions) {
        $this->sugestions = $sugestions;

        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getSugestions() {
        return $this->sugestions;
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
