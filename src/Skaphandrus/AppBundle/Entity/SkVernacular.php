<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkVernacular
 */
class SkVernacular {

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    private $species;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species_vernaculars;

    /**
     * Constructor
     */
    public function __construct() {
//        $this->species = new \Doctrine\Common\Collections\ArrayCollection();
        $this->species_vernaculars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkVernacular
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

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

//    /**
//     * Add speciesVernacular
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
//     *
//     * @return SkVernacular
//     */
//    public function addSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species) {
//        $this->species[] = $species;
//
//        return $this;
//    }
//
//    /**
//     * Remove speciesVernacular
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
//     */
//    public function removeSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species) {
//        $this->species->removeElement($species);
//    }
//
//    /**
//     * Get speciesVernaculars
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getSpecies() {
//        return $this->species;
//    }

    /**
     * Add speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     *
     * @return SkVernacular
     */
    public function addSpeciesVernacular(\Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular) {
        $this->species_vernaculars[] = $speciesVernacular;

        return $this;
    }

    /**
     * Remove speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     */
    public function removeSpeciesVernacular(\Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular) {
        $this->species_vernaculars->removeElement($speciesVernacular);
    }

    /**
     * Get speciesVernaculars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeciesVernaculars() {
        return $this->species_vernaculars;
    }

}
