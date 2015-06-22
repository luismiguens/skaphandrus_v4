<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPerson
 */
class SkPerson
{
    /**
     * @var integer
     */
    private $skaphandrusId;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $persontype;

    
    

//    /**
//     * @var \Skaphandrus\AppBundle\Entity\SkAddress
//     */
//    private $address;
//
//    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persontype = new \Doctrine\Common\Collections\ArrayCollection();
         $this->createdAt = new \DateTime();
    }

    /**
     * Set skaphandrusId
     *
     * @param integer $skaphandrusId
     *
     * @return SkPerson
     */
    public function setSkaphandrusId(\Skaphandrus\AppBundle\Entity\FosUser $skaphandrusId = null)
    {
        $this->skaphandrusId = $skaphandrusId;

        return $this;
    }

    /**
     * Get skaphandrusId
     *
     * @return integer
     */
    public function getSkaphandrusId()
    {
        return $this->skaphandrusId;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkPerson
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPerson
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
     * @return SkPerson
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;    /**
//     * @var \Skaphandrus\AppBundle\Entity\SkAddress
//     */
//    private $address;
//
//    
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
     * @return SkPerson
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
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkPerson
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

    /**
     * Add persontype
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPersonType $persontype
     *
     * @return SkPerson
     */
    public function addPersontype(\Skaphandrus\AppBundle\Entity\SkPersonType $persontype)
    {
        $this->persontype[] = $persontype;

        return $this;
    }

    /**
     * Remove persontype
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPersonType $persontype
     */
    public function removePersontype(\Skaphandrus\AppBundle\Entity\SkPersonType $persontype)
    {
        $this->persontype->removeElement($persontype);
    }

    /**
     * Get persontype
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersontype()
    {
        return $this->persontype;
    }
    

    
    public function doStuffOnPreUpdate()
    {
       $this->updatedAt = new \DateTime();
    }
    
    

}
