<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * SkPhylum
 */
class SkPhylum {

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    private $kingdom;

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
    private $class;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct() {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
        $this->class = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkPhylum
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
     * To String
     *
     * @return string
     */
    public function __toString() {
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
     * Set kingdom
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdom $kingdom
     *
     * @return SkPhylum
     */
    public function setKingdom(\Skaphandrus\AppBundle\Entity\SkKingdom $kingdom = null) {
        $this->kingdom = $kingdom;

        return $this;
    }

    /**
     * Get kingdom
     *
     * @return \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    public function getKingdom() {
        return $this->kingdom;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkPhylum
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
     * @param \Skaphandrus\AppBundle\Entity\SkPhylumVernacular $vernacular
     *
     * @return SkPhylum
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkPhylumVernacular $vernacular) {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylumVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkPhylumVernacular $vernacular) {
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
     * Set photos
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photos
     *
     * @return SkFamily
     */
    public function setPhotos($photos) {
        $this->photos = $photos;

        return $this;
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos() {
        return $this->photos;
    }

    /**
     * Add class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     *
     * @return SkPhylum
     */
    public function addClass(\Skaphandrus\AppBundle\Entity\SkClass $class) {
        $this->class[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     */
    public function removeClass(\Skaphandrus\AppBundle\Entity\SkClass $class) {
        $this->class->removeElement($class);
    }

    /**
     * Get class
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClass() {
        return $this->class;
    }

    public function getChildNodes() {
        return $this->getClass();
    }

    public function getTaxonNodeName() {
        return "phylum";
    }

    public function getParentNode() {
        return $this->getKingdom();
    }

    public function getSpecies() {
        $species = array();

        foreach ($this->getClass() as $class) {
            foreach ($this->getOrder() as $order) {
                foreach ($order->getFamily() as $family) {
                    foreach ($family->getGenus() as $genus) {
                        $species = array_merge($species, $genus->getSpecies()->toArray());
                    }
                }
            }
        }

        return new ArrayCollection($species);
    }

}
