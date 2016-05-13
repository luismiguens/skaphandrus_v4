<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * SkClass
 */
class SkClass {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    private $phylum;

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
    private $order;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct() {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkClass
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
     * Set fileName
     *
     * @param string $fileName
     *
     * @return SkClass
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName() {
        return $this->fileName;
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
     * Set phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkClass
     */
    public function setPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum = null) {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhylum
     */
    public function getPhylum() {
        return $this->phylum;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkClass
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
     * @param \Skaphandrus\AppBundle\Entity\SkClassVernacular $vernacular
     *
     * @return SkClass
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkClassVernacular $vernacular) {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClassVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkClassVernacular $vernacular) {
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
     * Add order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     *
     * @return SkClass
     */
    public function addOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order) {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     */
    public function removeOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order) {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrder() {
        return $this->order;
    }

    public function getChildNodes() {
        return $this->getOrder();
    }

    public function getTaxonNodeName() {
        return "class";
    }

    public function getParentNode() {
        return $this->getPhylum();
    }

    public function getSpecies() {
        $species = array();

        foreach ($this->getOrder() as $order) {
            foreach ($order->getFamily() as $family) {
                foreach ($family->getGenus() as $genus) {
                    $species = array_merge($species, $genus->getSpecies()->toArray());
                }
            }
        }

        return new ArrayCollection($species);
    }

}
