<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationCharacter
 */
class SkIdentificationCharacter
{

    use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    private $criteria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $phylum;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $order;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $genus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $class;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $family;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->phylum = new \Doctrine\Common\Collections\ArrayCollection();
        $this->species = new \Doctrine\Common\Collections\ArrayCollection();
        $this->order = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->class = new \Doctrine\Common\Collections\ArrayCollection();
        $this->family = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkIdentificationCharacter
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
     * Set criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     *
     * @return SkIdentificationCharacter
     */
    public function setCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria = null)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Add phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkIdentificationCharacter
     */
    public function addPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum)
    {
        $this->phylum[] = $phylum;

        return $this;
    }

    /**
     * Remove phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     */
    public function removePhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum)
    {
        $this->phylum->removeElement($phylum);
    }

    /**
     * Get phylum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Add species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkIdentificationCharacter
     */
    public function addSpecy(\Skaphandrus\AppBundle\Entity\SkSpecies $species)
    {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     */
    public function removeSpecy(\Skaphandrus\AppBundle\Entity\SkSpecies $species)
    {
        $this->species->removeElement($species);
    }

    /**
     * Get species
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Add order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     *
     * @return SkIdentificationCharacter
     */
    public function addOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     */
    public function removeOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkIdentificationCharacter
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

    /**
     * Add class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     *
     * @return SkIdentificationCharacter
     */
    public function addClass(\Skaphandrus\AppBundle\Entity\SkClass $class)
    {
        $this->class[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     */
    public function removeClass(\Skaphandrus\AppBundle\Entity\SkClass $class)
    {
        $this->class->removeElement($class);
    }

    /**
     * Get class
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Add family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkIdentificationCharacter
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
}

