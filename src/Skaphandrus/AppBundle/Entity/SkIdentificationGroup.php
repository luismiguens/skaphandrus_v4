<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationGroup
 */
class SkIdentificationGroup
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkGenus
     */
    private $genus;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    private $module;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkFamily
     */
    private $family;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkOrder
     */
    private $order;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkClass
     */
    private $class;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    private $phylum;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $criterias;

    /**
     * @var boolean
     */
    private $isParentModule = FALSE;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->criterias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {

        return ucfirst($this->getTaxonName()) .': '. $this->getTaxonValue()->getName();
    }

    public function getTaxonName() {
        if ($this->getPhylum()) {
            return 'phylum';
        }
        elseif ($this->getClass()) {
            return 'class';
        }
        elseif ($this->getOrder()) {
            return 'order';
        }
        elseif ($this->getFamily()) {
            return 'family';
        }
        elseif ($this->getGenus()) {
            return 'genus';
        }
    }

    public function getTaxonValue() {
        if ($this->getPhylum()) {
            return $this->getPhylum();
        }
        elseif ($this->getClass()) {
            return $this->getClass();
        }
        elseif ($this->getOrder()) {
            return $this->getOrder();
        }
        elseif ($this->getFamily()) {
            return $this->getFamily();
        }
        elseif ($this->getGenus()) {
            return $this->getGenus();
        }
    }

    public function getName() {
        return ucfirst($this->getTaxonName()) .': '. $this->getTaxonValue()->getName();
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
     * Set genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkIdentificationGroup
     */
    public function setGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus = null)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return \Skaphandrus\AppBundle\Entity\SkGenus
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Set module
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationModule $module
     *
     * @return SkIdentificationGroup
     */
    public function setModule(\Skaphandrus\AppBundle\Entity\SkIdentificationModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationModule
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkIdentificationGroup
     */
    public function setFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family = null)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \Skaphandrus\AppBundle\Entity\SkFamily
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     *
     * @return SkIdentificationGroup
     */
    public function setOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Skaphandrus\AppBundle\Entity\SkOrder
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     *
     * @return SkIdentificationGroup
     */
    public function setClass(\Skaphandrus\AppBundle\Entity\SkClass $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \Skaphandrus\AppBundle\Entity\SkClass
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkIdentificationGroup
     */
    public function setPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum = null)
    {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Add criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     *
     * @return SkIdentificationGroup
     */
    public function addCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria)
    {
        $this->criterias[] = $criteria;

        return $this;
    }

    /**
     * Remove criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     */
    public function removeCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria)
    {
        $this->criterias->removeElement($criteria);
    }

    /**
     * Get criterias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCriterias()
    {
        return $this->criterias;
    }

    /**
     * Set isParentModule
     *
     * @param boolean $isParentModule
     *
     * @return SkIdentificationGroup
     */
    public function setIsParentModule($isParentModule)
    {
        $this->isParentModule = $isParentModule;

        return $this;
    }

    /**
     * Get isParentModule
     *
     * @return boolean
     */
    public function getIsParentModule()
    {
        return $this->isParentModule;
    }
}
