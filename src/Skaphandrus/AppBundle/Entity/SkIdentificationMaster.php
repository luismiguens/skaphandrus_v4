<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationMaster
 */
class SkIdentificationMaster
{
    /**
     * @var boolean
     */
    private $isActive = '0';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SkIdentificationMaster
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
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
}

