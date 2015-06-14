<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkGenus
 */
class SkGenus {

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkFamily
     */
    private $family;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $character;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vernaculars;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species;

    /**
     * Constructor
     */
    public function __construct() {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
        $this->species = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkGenus
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

    /**
     * Set family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkGenus
     */
    public function setFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family = null) {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \Skaphandrus\AppBundle\Entity\SkFamily
     */
    public function getFamily() {
        return $this->family;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkGenus
     */
    public function addCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character) {
        $this->character[] = $character;

        return $this;
    }

    /**
     * Remove character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     */
    public function removeCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character) {
        $this->character->removeElement($character);
    }

    /**
     * Get character
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacter() {
        return $this->character;
    }

    /**
     * Add vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenusVernacular $vernacular
     *
     * @return SkGenus
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkGenusVernacular $vernacular) {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenusVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkGenusVernacular $vernacular) {
        $this->vernaculars->removeElement($vernacular);
    }

    /**
     * Get vernaculars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVernaculars() {
        return $this->vernaculars;
    }

    /**
     * Add species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkGenus
     */
    public function addSpecy(\Skaphandrus\AppBundle\Entity\SkSpecies $species) {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     */
    public function removeSpecy(\Skaphandrus\AppBundle\Entity\SkSpecies $species) {
        $this->species->removeElement($species);
    }

    /**
     * Get species
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecies() {
        return $this->species;
    }

    
    
    public function getChildNodes() {
        return $this->getSpecies();
    }
    
    public function getParentNode() {
        return $this->getFamily();
    }
    
    
    
    
    public function getTaxonNodeName(){
        return "genus";
        
    }
    

}
