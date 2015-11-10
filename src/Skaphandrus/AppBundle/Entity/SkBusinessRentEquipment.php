<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusinessRentEquipment
 */
class SkBusinessRentEquipment {

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $rentvalue;

    /**
     * @var integer
     */
    private $id;

//    /**
//     * @var \Skaphandrus\AppBundle\Entity\SkBusinessBoat
//     */
//    private $businessboat;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkEquipmentType
     */
    private $equipmenttype;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return SkBusinessRentEquipment
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
     * Set rentvalue
     *
     * @param integer $rentvalue
     *
     * @return SkBusinessRentEquipment
     */
    public function setRentvalue($rentvalue) {
        $this->rentvalue = $rentvalue;

        return $this;
    }

    /**
     * Get rentvalue
     *
     * @return integer
     */
    public function getRentvalue() {
        return $this->rentvalue;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

//    /**
//     * Set businessboat
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkBusinessBoat $businessboat
//     *
//     * @return SkBusinessRentEquipment
//     */
//    public function setBusinessboat(\Skaphandrus\AppBundle\Entity\SkBusinessBoat $businessboat = null) {
//        $this->businessboat = $businessboat;
//
//        return $this;
//    }
//
//    /**
//     * Get businessboat
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkBusinessBoat
//     */
//    public function getBusinessboat() {
//        return $this->businessboat;
//    }
//
    /**
     * Set equipmenttype
     *
     * @param \Skaphandrus\AppBundle\Entity\SkEquipmentType $equipmenttype
     *
     * @return SkBusinessRentEquipment
     */
    public function setEquipmenttype(\Skaphandrus\AppBundle\Entity\SkEquipmentType $equipmenttype = null) {
        $this->equipmenttype = $equipmenttype;

        return $this;
    }

    /**
     * Get equipmenttype
     *
     * @return \Skaphandrus\AppBundle\Entity\SkEquipmentType
     */
    public function getEquipmenttype() {
        return $this->equipmenttype;
    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkBusinessRentEquipment
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

}
