<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCourseTranslation
 */
class SkCourseTranslation {

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $description;

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
//     * @var \Skaphandrus\AppBundle\Entity\SkCourse
//     */
//    private $traslatable;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkCourseTranslation
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

//    /**
//     * Set locale
//     *
//     * @param string $locale
//     *
//     * @return SkCourseTranslation
//     */
//    public function setLocale($locale)
//    {
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
//    public function getLocale()
//    {
//        return $this->locale;
//    }
//
//    /**
//     * Get id
//     *
//     * @return integer
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * Set traslatable
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkCourse $traslatable
//     *
//     * @return SkCourseTranslation
//     */
//    public function setTraslatable(\Skaphandrus\AppBundle\Entity\SkCourse $traslatable = null)
//    {
//        $this->traslatable = $traslatable;
//
//        return $this;
//    }
//
//    /**
//     * Get traslatable
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkCourse
//     */
//    public function getTraslatable()
//    {
//        return $this->traslatable;
//    }
}
