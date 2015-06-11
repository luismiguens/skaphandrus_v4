<?php

namespace Skaphandrus\AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationModuleTranslation
 */
class SkIdentificationModuleTranslation
{
    
    
     use ORMBehaviors\Translatable\Translation;
    /**
     * @var string
     */
    private $name;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkIdentificationModuleTranslation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}

