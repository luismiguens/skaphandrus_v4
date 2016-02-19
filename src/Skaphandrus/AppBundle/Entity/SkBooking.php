<?php

namespace Skaphandrus\AppBundle\Entity;

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
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBookingDive
     */
    private $bookingDive;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBookingOtherActivity
     */
    private $bookingOtherActivity;

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
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
     * @return \DateTime
     */
    public function getBeginAt() {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
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
     * @return \DateTime
     */
    public function getEndAt() {
        return $this->endAt;
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
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBooking
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null) {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness() {
        return $this->business;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkBooking
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

    /**
     * Set bookingDive
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBookingDive $bookingDive
     *
     * @return SkBooking
     */
    public function setBookingDive(\Skaphandrus\AppBundle\Entity\SkBookingDive $bookingDive = null) {
        $this->bookingDive = $bookingDive;

        return $this;
    }

    /**
     * Get bookingDive
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBookingDive
     */
    public function getBookingDive() {
        return $this->bookingDive;
    }

    /**
     * Add bookingOtherActivity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBookingOtherActivity $bookingOtherActivity
     *
     * @return SkBookingOtherActivity
     */
    public function addBookingOtherActivity(\Skaphandrus\AppBundle\Entity\SkBookingOtherActivity $bookingOtherActivity) {
        $this->bookingOtherActivity[] = $bookingOtherActivity;
        $bookingOtherActivity->setBooking($this);

        return $this;
    }

    /**
     * Remove bookingOtherActivity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBookingOtherActivity $bookingOtherActivity
     */
    public function removeBookingOtherActivity(\Skaphandrus\AppBundle\Entity\SkBookingOtherActivity $bookingOtherActivity) {
        $this->bookingOtherActivity->removeElement($bookingOtherActivity);
    }

    /**
     * Get bookingOtherActivity
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookingOtherActivity() {
        return $this->bookingOtherActivity;
    }

}
