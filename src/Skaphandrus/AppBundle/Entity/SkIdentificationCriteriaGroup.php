<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationCriteriaGroup
 */
class SkIdentificationCriteriaGroup {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    private $criteria;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationGroup
     */
    private $group;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     *
     * @return SkIdentificationCriteriaGroup
     */
    public function setCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria = null) {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * Set group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     *
     * @return SkIdentificationCriteriaGroup
     */
    public function setGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group = null) {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationGroup
     */
    public function getGroup() {
        return $this->group;
    }

    private $specie;

    
    public function __construct()
    {
        $this->specie = new \Doctrine\Common\Collections\ArrayCollection();
    }
//    /**
//     * Set specie
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $specie
//     *
//     * @return SkIdentificationCriteriaGroup
//     */
//    public function setSpecie(\Skaphandrus\AppBundle\Entity\SkSpecies $specie = null) {
//        $this->specie = $specie;
//
//        return $this;
//    }
//
//    /**
//     * Get specie
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationGroup
//     */
//    public function getSpecie() {
//        return $this->specie;
//    }
    
    /**
     * Add specie
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $specie
     *
     * @return SkIdentificationCriteriaGroup
     */
    public function addSpecie(\Skaphandrus\AppBundle\Entity\SkSpecies $specie)
    {
        $this->specie[] = $specie;

        return $this;
    }

    /**
     * Remove specie
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $specie
     */
    public function removeSpecie(\Skaphandrus\AppBundle\Entity\SkSpecies $specie)
    {
        $this->specie->removeElement($specie);
    }

    /**
     * Get specie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecie()
    {
        return $this->specie;
    }

}