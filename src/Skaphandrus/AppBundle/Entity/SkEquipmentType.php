<?php

namespace Skaphandrus\AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkEquipmentType
 */
class SkEquipmentType {

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

    public function __toString() {
        return $this->translate()->getName();
    }

}
