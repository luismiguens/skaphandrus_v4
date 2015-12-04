<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPersonal
 */
class SkPersonal {

    /**
     * @var string
     */
    private $honorific;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $middlename;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $birthname;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var boolean
     */
    private $smoking = '0';

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var string
     */
    private $passport;

    /**
     * @var string
     */
    private $bloodgroup;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSexType
     */
    private $sexType;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPerson
     */
    private $person;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    
 
        
    /**
     * Constructor
     */
    public function __construct() {
        $this->updatedAt = new \DateTime();
    }
    
    
    
    /**
     * Set honorific
     *
     * @param string $honorific
     *
     * @return SkPersonal
     */
    public function setHonorific($honorific) {
        $this->honorific = $honorific;

        return $this;
    }

    /**
     * Get honorific
     *
     * @return string
     */
    public function getHonorific() {
        return ( ! $this->honorific ) ? 'Scuba diver' : $this->honorific;
        //return $this->honorific;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return SkPersonal
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return SkPersonal
     */
    public function setMiddlename($middlename) {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename() {
        return $this->middlename;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return SkPersonal
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set birthname
     *
     * @param string $birthname
     *
     * @return SkPersonal
     */
    public function setBirthname($birthname) {
        $this->birthname = $birthname;

        return $this;
    }

    /**
     * Get birthname
     *
     * @return string
     */
    public function getBirthname() {
        return $this->birthname;
    }

    /**
     * Set height
     *
     * @param float $height
     *
     * @return SkPersonal
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return SkPersonal
     */
    public function setWeight($weight) {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Set smoking
     *
     * @param boolean $smoking
     *
     * @return SkPersonal
     */
    public function setSmoking($smoking) {
        $this->smoking = $smoking;

        return $this;
    }

    /**
     * Get smoking
     *
     * @return boolean
     */
    public function getSmoking() {
        return $this->smoking;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return SkPersonal
     */
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate() {
        return $this->birthdate;
    }

    /**
     * Set passport
     *
     * @param string $passport
     *
     * @return SkPersonal
     */
    public function setPassport($passport) {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get passport
     *
     * @return string
     */
    public function getPassport() {
        return $this->passport;
    }

    /**
     * Set bloodgroup
     *
     * @param string $bloodgroup
     *
     * @return SkPersonal
     */
    public function setBloodgroup($bloodgroup) {
        $this->bloodgroup = $bloodgroup;

        return $this;
    }

    /**
     * Get bloodgroup
     *
     * @return string
     */
    public function getBloodgroup() {
        return $this->bloodgroup;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPersonal
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SkPersonal
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set sexType
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSexType $sexType
     *
     * @return SkPersonal
     */
    public function setSexType(\Skaphandrus\AppBundle\Entity\SkSexType $sexType = null) {
        $this->sexType = $sexType;

        return $this;
    }

    /**
     * Get sexType
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSexType
     */
    public function getSexType() {
        return $this->sexType;
    }

    /**
     * Set person
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPerson $person
     *
     * @return SkPersonal
     */
    public function setPerson(\Skaphandrus\AppBundle\Entity\SkPerson $person = null) {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPerson
     */
    public function getPerson() {
        return $this->person;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPersonal
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser() {
        return $this->fosUser;
    }

    public function getName() {
        
        $name = "";
        
        if ($this->getMiddlename() == null && $this->getLastname() == null):
            $name = $this->getFirstname();
        elseif ($this->getMiddlename() != null && $this->getLastname() == null):
            $name = $this->getFirstname() . " " . $this->getMiddlename();
        elseif ($this->getMiddlename() == null and $this->getLastname() != null):
            $name = $this->getFirstname() . " " . $this->getLastname();
        else:
            $name = $this->getFirstname() . " " . $this->getMiddlename() . " " . $this->getLastname();
        endif;
        
        return ucfirst($name);
    }

    
    public function __toString() {
        return $this->getName();
    }
    
    
}
