<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkSpotTranslation
 */
class SkSpotTranslation
{

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

//    /**
//     * @var integer
//     */
//    private $translatable_id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkSpotTranslation
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkSpotTranslation
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

//    /**
//     * Set translatableId
//     *
//     * @param integer $translatableId
//     *
//     * @return SkSpotTranslation
//     */
//    public function setTranslatableId($translatableId)
//    {
//        $this->translatable_id = $translatableId;
//
//        return $this;
//    }
//
//    /**
//     * Get translatableId
//     *
//     * @return integer
//     */
//    public function getTranslatableId()
//    {
//        return $this->translatable_id;
//    }
}
