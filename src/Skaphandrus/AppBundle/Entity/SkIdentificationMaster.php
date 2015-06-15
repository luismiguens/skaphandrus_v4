<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationMaster
 */
class SkIdentificationMaster
{
    use ORMBehaviors\Translatable\Translatable;

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

    /**
     * To String Method
     *
     * @return  String
     */
    public function __toString() {
        return $this->translate()->getName();
    }
}

