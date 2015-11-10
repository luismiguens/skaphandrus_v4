<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkEquipmentType
 */
class SkEquipmentType
{
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    public function __toString() {
        return $this->getId()."";
    }
    
    
    
    
    
}

