<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBookingDive
 */
class SkBookingDive {

    /**
     * @var integer
     */
    private $pax;

    /**
     * @var integer
     */
    private $numberDives;

    /**
     * @var \DateTime
     */
    private $dateAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBooking
     */
    private $booking;

    /**
     * Set pax
     *
     * @param integer $pax
     *
     * @return SkBookingDive
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
     * Set numberDives
     *
     * @param integer $numberDives
     *
     * @return SkBookingDive
     */
    public function setNumberDives($numberDives) {
        $this->numberDives = $numberDives;

        return $this;
    }

    /**
     * Get numberDives
     *
     * @return integer
     */
    public function getNumberDives() {
        return $this->numberDives;
    }

    /**
     * Set dateAt
     *
     * @param \DateTime $dateAt
     *
     * @return SkBookingDive
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    
        /**
     * Get booking
     *
     * @return \DateTime
     */
    public function setBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking) {
       $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return 
     */
    public function getBooking() {
        return $this->booking;
    }

}
