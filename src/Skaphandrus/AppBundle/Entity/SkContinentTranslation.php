<?php

namespace Skaphandrus\AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkContinentTranslation
 */
class SkContinentTranslation {

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
//     * @var \Skaphandrus\AppBundle\Entity\SkContinent
//     */
//    private $translatable;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkContinentTranslation
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
//     * @return SkContinentTranslation
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
//     * @param \Skaphandrus\AppBundle\Entity\SkContinent $translatable
//     *
//     * @return SkContinentTranslation
//     */
//    public function setTranslatable(\Skaphandrus\AppBundle\Entity\SkContinent $translatable = null) {
//        $this->translatable = $translatable;
//
//        return $this;
//    }
//
//    /**
//     * Get translatable
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkContinent
//     */
//    public function getTranslatable() {
//        return $this->translatable;
//    }
}
