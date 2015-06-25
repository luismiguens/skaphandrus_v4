<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationModuleUsername
 */
class SkIdentificationAcquisition {

    /**
     * @var integer
     */
    private $acquisitionType;

    /**
     * @var \DateTime
     */
    private $acquiredAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    private $module;

    public function __construct() {
        $this->acquisitionType = 1;
        $this->acquiredAt = new \DateTime();
    }

    /**
     * Set acquisitionType
     *
     * @param integer $acquisitionType
     *
     * @return SkIdentificationModuleUsername
     */
    public function setAcquisitionType($acquisitionType) {
        $this->acquisitionType = $acquisitionType;

        return $this;
    }

    /**
     * Get acquisitionType
     *
     * @return integer
     */
    public function getAcquisitionType() {
            return $this->acquisitionType;
    }
    
    
        /**
     * Get acquisitionType
     *
     * @return integer
     */
    public function getAcquisitionTypeName() {

        if ($this->acquisitionType == 1) {
            return "points";
        } elseif ($this->acquisitionType == 2) {
            return "store";
        }
    }

    /**
     * Set acquiredAt
     *
     * @param \DateTime $acquiredAt
     *
     * @return SkIdentificationModuleUsername
     */
    public function setAcquiredAt($acquiredAt) {
        $this->acquiredAt = $acquiredAt;

        return $this;
    }

    /**
     * Get acquiredAt
     *
     * @return \DateTime
     */
    public function getAcquiredAt() {
        return $this->acquiredAt;
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
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkIdentificationModuleUsername
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
     * Set module
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationModule $module
     *
     * @return SkIdentificationModuleUsername
     */
    public function setModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module = null) {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    public function getModule() {
        return $this->module;
    }

}
