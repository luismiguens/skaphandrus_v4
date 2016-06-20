<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkVernacular
 */
class SkVernacular
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
     * @var \Doctrine\Common\Collections\Collection
     */

    private $species;
    
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkVernacular
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
     * Constructor
     */
    public function __construct()
    {
        $this->species = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     *
     * @return SkVernacular
     */
    public function addSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species)
    {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     */
    public function removeSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species)
    {
        $this->species->removeElement($species);
    }

    /**
     * Get speciesVernaculars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecies()
    {
        return $this->species;
    }
}
