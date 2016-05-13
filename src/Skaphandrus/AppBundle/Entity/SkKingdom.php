<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkKingdom
 */
class SkKingdom {

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vernaculars;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $phylum;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct() {
        $this->vernaculars = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phylum = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkKingdom
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
     * Add vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular
     *
     * @return SkKingdom
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular) {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular) {
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
     * Add phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkKingdom
     */
    public function addPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum) {
        $this->phylum[] = $phylum;

        return $this;
    }

    /**
     * Remove phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     */
    public function removePhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum) {
        $this->phylum->removeElement($phylum);
    }

    /**
     * Get phylum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhylum() {
        return $this->phylum;
    }

    public function getChildNodes() {
        return $this->getPhylum();
    }

    public function getTaxonNodeName() {
        return "kingdom";
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

}
