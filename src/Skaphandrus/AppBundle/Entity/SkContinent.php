<?php

namespace Skaphandrus\AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkContinent
 */
class SkContinent {

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
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function __toString() {
        return $this->getName();
    }

}
