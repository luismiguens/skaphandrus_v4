<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkEquipmentTypeTranslation
 */
class SkEquipmentTypeTranslation {

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $name;

//    /**
//     * @var string
//     */
//    private $locale;
//
//    /**
//     * @var integer
//     */
//    private $id;
//
//    /**
//     * @var \Skaphandrus\AppBundle\Entity\SkEquipmentType
//     */
//    private $translatable;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkEquipmentTypeTranslation
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

//    /**
//     * Set locale
//     *
//     * @param string $locale
//     *
//     * @return SkEquipmentTypeTranslation
//     */
//    public function setLocale($locale) {
//        $this->locale = $locale;
//
//        return $this;
//    }
//
//    /**
//     * Get locale
//     *
//     * @return string
//     */
//    public function getLocale() {
//        return $this->locale;
//    }
//
//    /**
//     * Get id
//     *
//     * @return integer
//     */
//    public function getId() {
//        return $this->id;
//    }
//
//    /**
//     * Set translatable
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkEquipmentType $translatable
//     *
//     * @return SkEquipmentTypeTranslation
//     */
//    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkEquipmentType $translatable = null) {
//        $this->translatable = $translatable;
//
//        return $this;
//    }
//
//    /**
//     * Get translatable
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkEquipmentType
//     */
//    public function getTranslatable() {
//        return $this->translatable;
//    }

}
