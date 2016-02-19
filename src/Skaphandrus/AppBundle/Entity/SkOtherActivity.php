<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkOtherActivity
 */
class SkOtherActivity {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBookingOtherActivity
     */
    private $bookingOtherActivity;

    /**
     * Constructor
     */
    public function __construct() {
        $this->business = new ArrayCollection();
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function __toString() {
        return $this->getName();
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
     * Add business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkOtherActivity
     */
    public function addBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
        $this->business[] = $business;

        return $this;
    }

    /**
     * Remove business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     */
    public function removeBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
        $this->business->removeElement($business);
    }

    /**
     * Get business
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBusiness() {
        return $this->business;
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
