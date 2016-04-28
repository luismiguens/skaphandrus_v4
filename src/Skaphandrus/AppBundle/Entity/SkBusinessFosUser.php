<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessFosUser
 */
class SkBusinessFosUser {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $businessName;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $businessEmail;

    /**
     * @var string
     */
    private $observations;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkBusiness
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {

        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SkBusiness
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {

        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return SkBusiness
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {

        return $this->password;
    }

    /**
     * Set businessName
     *
     * @param string $businessName
     *
     * @return SkBusiness
     */
    public function setBusinessName($businessName) {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string
     */
    public function getBusinessName() {

        return $this->businessName;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return SkBusiness
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation() {

        return $this->location;
    }

    /**
     * Set businessEmail
     *
     * @param string $businessEmail
     *
     * @return SkBusiness
     */
    public function setBusinessEmail($businessEmail) {
        $this->businessEmail = $businessEmail;

        return $this;
    }

    /**
     * Get businessEmail
     *
     * @return string
     */
    public function getBusinessEmail() {

        return $this->businessEmail;
    }
    
        /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkBusiness
     */
    public function setObservations($observations) {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations() {

        return $this->observations;
    }

}
