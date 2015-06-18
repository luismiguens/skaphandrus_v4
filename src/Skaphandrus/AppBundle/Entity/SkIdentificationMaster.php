<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationMaster
 */
class SkIdentificationMaster
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var boolean
     */
    private $isActive = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $modules;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SkIdentificationMaster
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
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

    /**
     * To String Method
     *
     * @return  String
     */
    public function __toString() {
        return $this->translate()->getName();
    }

    /**
     * Add module
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationModule $module
     *
     * @return SkIdentificationMaster
     */
    public function addModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationModule $module
     */
    public function removeModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }
}
