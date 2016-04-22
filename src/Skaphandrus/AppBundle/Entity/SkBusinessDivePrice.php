<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessDivePrice
 */
class SkBusinessDivePrice {

    /**
     * @var integer
     */
    private $numberofdives;

    /**
     * @var integer
     */
    private $valueperdives;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * @var Collection
     */
    private $package;

//    /**
//     * @var Collection
//     */
//    private $booking;
//    
//    /**
//     * Add booking
//     *
//     * @param SkBooking $booking
//     *
//     * @return SkCurrency
//     */
//    public function addBooking(SkBooking $booking) {
//        $this->booking[] = $booking;
//
//        return $this;
//    }
//
//    /**
//     * Remove booking
//     *
//     * @param SkBooking $booking
//     */
//    public function removeBooking(SkBooking $booking) {
//        $this->booking->removeElement($booking);
//    }
//
//    /**
//     * Get booking
//     *
//     * @return Collection
//     */
//    public function getBooking() {
//        return $this->booking;
//    }

    /**
     * Set numberofdives
     *
     * @param integer $numberofdives
     *
     * @return SkBusinessDivePrice
     */
    public function setNumberofdives($numberofdives) {
        $this->numberofdives = $numberofdives;

        return $this;
    }

    /**
     * Get numberofdives
     *
     * @return integer
     */
    public function getNumberofdives() {
        return $this->numberofdives;
    }

    /**
     * Set valueperdives
     *
     * @param integer $valueperdives
     *
     * @return SkBusinessDivePrice
     */
    public function setValueperdives($valueperdives) {
        $this->valueperdives = $valueperdives;

        return $this;
    }

    /**
     * Get valueperdives
     *
     * @return integer
     */
    public function getValueperdives() {
        return $this->valueperdives;
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
     * @return SkBusinessDivePrice
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
     * Add package
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBookingPackage $package
     *
     * @return SkBookingPackage
     */
    public function addBookingPackage(\Skaphandrus\AppBundle\Entity\SkBookingPackage $package) {
        $this->package[] = $package;
        $package->setBooking($this);

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBookingPackage $package
     */
    public function removeBookingPackage(\Skaphandrus\AppBundle\Entity\SkBookingPackage $package) {
        $this->package->removeElement($package);
    }

    /**
     * Get package
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookingPackage() {
        return $this->package;
    }

    public function __toString() {
        return $this->getNumberofdives() . " dives, " . $this->getValueperdives() . " €";
    }

}
