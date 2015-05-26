<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCreativeCommons
 */
class SkCreativeCommons
{
    
        use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkCreativeCommons
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
    
    
    public function getName() {
        return $this->__toString();
    }
    
    
    public function __toString(){
        return $this->translate()->getName();
    }
    
    
}

