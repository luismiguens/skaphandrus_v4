<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;


/**
 * SkSpeciesTranslation
 */
class SkSpeciesTranslation
{
    
    use ORMBehaviors\Translatable\Translation;
    
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $howToFind;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkSpeciesTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set howToFind
     *
     * @param string $howToFind
     *
     * @return SkSpeciesTranslation
     */
    public function setHowToFind($howToFind)
    {
        $this->howToFind = $howToFind;

        return $this;
    }

    /**
     * Get howToFind
     *
     * @return string
     */
    public function getHowToFind()
    {
        return $this->howToFind;
    }
}

