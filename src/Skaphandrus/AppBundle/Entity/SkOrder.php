<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * SkOrder
 */
class SkOrder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkClass
     */
    private $class;

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
    private $family;

    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
        $this->family = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkOrder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     *
     * @return SkOrder
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
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkOrder
     */
    public function addCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character)
    {
        $this->character[] = $character;

        return $this;
    }

    /**
     * Remove character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     */
    public function removeCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character)
    {
        $this->character->removeElement($character);
    }

    /**
     * Get character
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Add vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrderVernacular $vernacular
     *
     * @return SkOrder
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkOrderVernacular $vernacular)
    {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrderVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkOrderVernacular $vernacular)
    {
        $this->vernaculars->removeElement($vernacular);
    }

    /**
     * Get vernaculars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVernaculars()
    {
        return $this->vernaculars;
    }


    /**
     * Add family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkOrder
     */
    public function addFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family)
    {
        $this->family[] = $family;

        return $this;
    }

    /**
     * Remove family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     */
    public function removeFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family)
    {
        $this->family->removeElement($family);
    }

    /**
     * Get family
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamily()
    {
        return $this->family;
    }
    
    
        
    public function getChildNodes() {
        return $this->getFamily();
    }
    
    
    
    public function getTaxonNodeName(){
        return "order";
        
    }
    
    
        public function getParentNode() {
        return $this->getClass();
    }
    
    
    
    public function getSpecies() {
        $species = array();

        foreach ($this->getFamily() as $family) {
            foreach ($family->getGenus() as $genus) {
                $species = array_merge($species, $genus->getSpecies()->toArray());
            }
        }
        return new ArrayCollection($species);
    }
    
    
}
