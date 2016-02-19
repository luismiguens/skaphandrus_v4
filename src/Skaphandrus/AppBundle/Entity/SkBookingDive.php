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
     * Add booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     *
     * @return SkBookingDive
     */
    public function addBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking) {
        $this->booking[] = $booking;
        $booking->setBookingDive($this);

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     */
    public function removeBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking) {
        $this->booking->removeElement($booking);
    }

    /**
     * Get booking
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooking() {
        return $this->booking;
    }

}
