<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhylum
 */
class SkPhylum
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
     * @var \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    private $kingdom;

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
     * Set name
     *
     * @param string $name
     *
     * @return SkPhylum
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
     * Set kingdom
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKingdom $kingdom
     *
     * @return SkPhylum
     */
    public function setKingdom(\Skaphandrus\AppBundle\Entity\SkKingdom $kingdom = null)
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    /**
     * Get kingdom
     *
     * @return \Skaphandrus\AppBundle\Entity\SkKingdom
     */
    public function getKingdom()
    {
        return $this->kingdom;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkPhylum
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

