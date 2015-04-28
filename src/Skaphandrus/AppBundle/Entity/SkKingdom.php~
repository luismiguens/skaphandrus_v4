<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkKingdom
 */
class SkKingdom
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
    private $vernaculars;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkKingdom
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
        $this->vernaculars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular
     *
     * @return SkKingdom
     */
    public function addVernacular(\Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular)
    {
        $this->vernaculars[] = $vernacular;

        return $this;
    }

    /**
     * Remove vernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular
     */
    public function removeVernacular(\Skaphandrus\AppBundle\Entity\SkKingdomVernacular $vernacular)
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
}
