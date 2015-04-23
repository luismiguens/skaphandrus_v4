<?php

namespace Skaphandrus\AppBundle\Entity;

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
}

