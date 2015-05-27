<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkFamily
 */
class SkFamily
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
     * @var \Skaphandrus\AppBundle\Entity\SkOrder
     */
    private $order;

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
    private $genus;


    
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genus = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkFamily
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
     * Set order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     *
     * @return SkFamily
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
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkFamily
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
     * @param \Skaphandrus\AppBundle\Entity\SkFamilyVernacular $vernacular
     *
     * @return SkFamily
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkFamilyVernacular $vernacular)
    {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamilyVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkFamilyVernacular $vernacular)
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
     * Add genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkFamily
     */
    public function addGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus)
    {
        $this->genus[] = $genus;

        return $this;
    }

    /**
     * Remove genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     */
    public function removeGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus)
    {
        $this->genus->removeElement($genus);
    }

    /**
     * Get genus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenus()
    {
        return $this->genus;
    }
    
    
        
    public function getChildNodes() {
        return $this->getGenus();
    }
    
    
    
    public function getTaxonNodeName(){
        return "family";
        
    }
    
        public function getParentNode() {
        return $this->getOrder();
    }
    
    
}
