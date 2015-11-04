<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkAddress
 */
class SkAddress
{
    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $street;

    /**
     * @var integer
     */
    private $shopId;

    /**
     * @var integer
     */
    private $personId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $coordinate;

    /**
     * @var string
     */
    private $zoom;

    /**
     * @var integer
     */
    private $accomodationId;

    /**
     * @var integer
     */
    private $operatorId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkLocation
     */
    private $location;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;


     /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    
    
    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return SkAddress
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return SkAddress
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return SkAddress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set shopId
     *
     * @param integer $shopId
     *
     * @return SkAddress
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * Get shopId
     *
     * @return integer
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * Set personId
     *
     * @param integer $personId
     *
     * @return SkAddress
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return integer
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkAddress
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SkAddress
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set coordinate
     *
     * @param string $coordinate
     *
     * @return SkAddress
     */
    public function setCoordinate($coordinate)
    {
        $this->coordinate = $coordinate;

        return $this;
    }

    /**
     * Get coordinate
     *
     * @return string
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Set zoom
     *
     * @param string $zoom
     *
     * @return SkAddress
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom
     *
     * @return string
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set accomodationId
     *
     * @param integer $accomodationId
     *
     * @return SkAddress
     */
    public function setAccomodationId($accomodationId)
    {
        $this->accomodationId = $accomodationId;

        return $this;
    }

    /**
     * Get accomodationId
     *
     * @return integer
     */
    public function getAccomodationId()
    {
        return $this->accomodationId;
    }

    /**
     * Set operatorId
     *
     * @param integer $operatorId
     *
     * @return SkAddress
     */
    public function setOperatorId($operatorId)
    {
        $this->operatorId = $operatorId;

        return $this;
    }

    /**
     * Get operatorId
     *
     * @return integer
     */
    public function getOperatorId()
    {
        return $this->operatorId;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkAddress
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Set location
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLocation $location
     *
     * @return SkAddress
     */
    public function setLocation(\Skaphandrus\AppBundle\Entity\SkLocation $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \Skaphandrus\AppBundle\Entity\SkLocation
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkAddress
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null)
    {
       
        $this->business = $business;
         

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness()
    {
        return $this->business;
    }
}

