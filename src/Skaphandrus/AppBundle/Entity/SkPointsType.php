<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPointsType
 */
class SkPointsType
{
    
        use ORMBehaviors\Translatable\Translatable;
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
    
    
        /**
     * Get id
     *
     * @return integer
     */
    public function setId($id)
    {
        return $this->id = $id;
    }
    
    
    
 
    public function __toString() {
        return $this->getName();
    }
    
    public function getName() {
        return $this->translate()->getName();
    }
    
}

