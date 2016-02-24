<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBookingOtherActivity
 */
class SkBookingOtherActivity {

    /**
     * @var integer
     */
    private $pax;

    /**
     * @var \DateTime
     */
    private $dateAt;

    /**
     * @var integer
     */
    private $schedule;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkOtherActivity
     */
    private $otherActivity;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBooking
     */
    private $booking;

    /**
     * Set pax
     *
     * @param integer $pax
     *
     * @return SkBookingOtherActivity
     */
    public function setPax($pax) {
        $this->pax = $pax;

        return $this;
    }

    /**
     * Get pax
     *
     * @return integer
     */
    public function getPax() {
        return $this->pax;
    }

    /**
     * Set dateAt
     *
     * @param \DateTime $dateAt
     *
     * @return SkBookingOtherActivity
     */
    public function setDateAt($dateAt) {
        $this->dateAt = $dateAt;

        return $this;
    }

    /**
     * Get dateAt
     *
     * @return \DateTime
     */
    public function getDateAt() {
        return $this->dateAt;
    }

    /**
     * Set schedule
     *
     * @param integer $schedule
     *
     * @return SkBookingOtherActivity
     */
    public function setSchedule($schedule) {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return integer
     */
    public function getSchedule() {
        return $this->schedule;
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
     * Set otherActivity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity
     *
     * @return SkBookingOtherActivity
     */
    public function setOtherActivity(\Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity = null) {
        $this->otherActivity = $otherActivity;

        return $this;
    }

    /**
     * Get otherActivity
     *
     * @return \Skaphandrus\AppBundle\Entity\SkOtherActivity
     */
    public function getOtherActivity() {
        return $this->otherActivity;
    }

    /**
     * Set booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     *
     * @return SkBookingOtherActivity
     */
    public function setBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking = null) {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBooking
     */
    public function getBooking() {
        return $this->booking;
    }

    
    
//    public function __toString() {
//        return $this->get;
//    }
    
    
}
