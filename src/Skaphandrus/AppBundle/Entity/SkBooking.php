<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * SkBooking
 */
class SkBooking {

    /**
     * @var \DateTime
     */
    private $beginAt;

    /**
     * @var \DateTime
     */
    private $endAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $certificationLevel;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var integer
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var SkBusiness
     */
    private $business;

    /**
     * @var FosUser
     */
    private $fosUser;

    /**
     * @var SkBookingDive
     */
    private $bookingDive;

    /**
     * @var SkBookingOtherActivity
     */
    private $bookingOtherActivity;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set beginAt
     *
     * @param \Date $beginAt
     *
     * @return SkBooking
     */
    public function setBeginAt($beginAt) {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \Date
     */
    public function getBeginAt() {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \Date $endAt
     *
     * @return SkBooking
     */
    public function setEndAt($endAt) {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \Date
     */
    public function getEndAt() {
        return $this->endAt;
    }

    /**
     * Set createdAt
     *
     * @param \Date $createdAt
     *
     * @return SkBooking
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \Date
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set certificationLevel
     *
     * @param integer $certificationLevel
     *
     * @return SkBooking
     */
    public function setCertificationLevel($certificationLevel) {
        $this->certificationLevel = $certificationLevel;

        return $this;
    }

    /**
     * Get certificationLevel
     *
     * @return integer
     */
    public function getCertificationLevel() {
        return $this->certificationLevel;
    }

    /**
     * Set specialNeed
     *
     * @param string $observations
     *
     * @return SkBooking
     */
    public function setObservations($observations) {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get specialNeed
     *
     * @return string
     */
    public function getObservations() {
        return $this->observations;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return SkBooking
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SkBooking
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set business
     *
     * @param SkBusiness $business
     *
     * @return SkBooking
     */
    public function setBusiness(SkBusiness $business = null) {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return SkBusiness
     */
    public function getBusiness() {
        return $this->business;
    }

    /**
     * Set fosUser
     *
     * @param FosUser $fosUser
     *
     * @return SkBooking
     */
    public function setFosUser(FosUser $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return FosUser
     */
    public function getFosUser() {
        return $this->fosUser;
    }

//    /**
//     * Set bookingDive
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkBookingDive $bookingDive
//     *
//     * @return SkBooking
//     */
//    public function setBookingDive(\Skaphandrus\AppBundle\Entity\SkBookingDive $bookingDive = null) {
//        $this->bookingDive = $bookingDive;
//
//        return $this;
//    }
//
//    /**
//     * Get bookingDive
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkBookingDive
//     */
//    public function getBookingDive() {
//        return $this->bookingDive;
//    }

    /**
     * Add bookingOtherActivity
     *
     * @param SkBookingOtherActivity $bookingOtherActivity
     *
     * @return SkBookingOtherActivity
     */
    public function addBookingOtherActivity(SkBookingOtherActivity $bookingOtherActivity) {
        $this->bookingOtherActivity[] = $bookingOtherActivity;
        $bookingOtherActivity->setBooking($this);

        return $this;
    }

    /**
     * Remove bookingOtherActivity
     *
     * @param SkBookingOtherActivity $bookingOtherActivity
     */
    public function removeBookingOtherActivity(SkBookingOtherActivity $bookingOtherActivity) {
        $this->bookingOtherActivity->removeElement($bookingOtherActivity);
    }

    /**
     * Get bookingOtherActivity
     *
     * @return Collection
     */
    public function getBookingOtherActivity() {
        return $this->bookingOtherActivity;
    }

    /**
     * Add bookingDive
     *
     * @param SkBookingDive $bookingDive
     *
     * @return SkBookingDive
     */
    public function addBookingDive(SkBookingDive $bookingDive) {
        $this->bookingDive[] = $bookingDive;
        $bookingDive->setBooking($this);

        return $this;
    }

    /**
     * Remove bookingDive
     *
     * @param SkBookingDive $bookingDive
     */
    public function removeBookingDive(SkBookingDive $bookingDive) {
        $this->bookingDive->removeElement($bookingDive);
    }

    /**
     * Get bookingDive
     *
     * @return Collection
     */
    public function getBookingDive() {
        return $this->bookingDive;
    }

}
