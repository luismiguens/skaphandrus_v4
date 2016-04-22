<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBookingPackage
 */
class SkBookingPackage {

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessDivePrice
     */
    private $bookingPackage;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBooking
     */
    private $booking;

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return SkBookingPackage
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity() {
        return $this->quantity;
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
     * Set bookingPackage
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $bookingPackage
     *
     * @return SkBookingPackage
     */
    public function setBookingPackage(\Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $bookingPackage = null) {
        $this->bookingPackage = $bookingPackage;

        return $this;
    }

    /**
     * Get bookingPackage
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessDivePrice
     */
    public function getBookingPackage() {
        return $this->bookingPackage;
    }

    /**
     * Set booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     *
     * @return SkBookingPackage
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

}
