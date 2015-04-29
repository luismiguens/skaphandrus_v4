<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkLocation
 */
class SkLocation
{

    use ORMBehaviors\Translatable\Translatable;

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
     * @var \Skaphandrus\AppBundle\Entity\SkRegion
     */
    private $region;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $spots;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkLocation
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
     * @return SkLocation
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set region
     *
     * @param \Skaphandrus\AppBundle\Entity\SkRegion $region
     *
     * @return SkLocation
     */
    public function setRegion(\Skaphandrus\AppBundle\Entity\SkRegion $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Skaphandrus\AppBundle\Entity\SkRegion
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->spots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkLocation
     */
    public function addSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot)
    {
        $this->spots[] = $spot;

        return $this;
    }

    /**
     * Remove spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     */
    public function removeSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot)
    {
        $this->spots->removeElement($spot);
    }

    /**
     * Get spots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpots()
    {
        return $this->spots;
    }
}
