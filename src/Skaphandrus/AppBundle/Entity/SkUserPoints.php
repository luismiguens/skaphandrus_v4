<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkUserPoints
 */
class SkUserPoints
{
    /**
     * @var integer
     */
    private $points;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPointsType
     */
    private $pointsType;


    /**
     * Set points
     *
     * @param integer $points
     *
     * @return SkUserPoints
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
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
     * @return SkUserPoints
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
     * Set pointsType
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPointsType $pointsType
     *
     * @return SkUserPoints
     */
    public function setPointsType(\Skaphandrus\AppBundle\Entity\SkPointsType $pointsType = null)
    {
        $this->pointsType = $pointsType;

        return $this;
    }

    /**
     * Get pointsType
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPointsType
     */
    public function getPointsType()
    {
        return $this->pointsType;
    }
}

