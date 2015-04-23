<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSpecies
 */
class SkSpecies
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkGenus
     */
    private $genus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $character;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkSpecies
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SkSpecies
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkSpecies
     */
    public function setGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus = null)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return \Skaphandrus\AppBundle\Entity\SkGenus
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkSpecies
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
}

