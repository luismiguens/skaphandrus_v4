<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPersonType
 */
class SkPersonType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $person;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add person
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPerson $person
     *
     * @return SkPersonType
     */
    public function addPerson(\Skaphandrus\AppBundle\Entity\SkPerson $person)
    {
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPerson $person
     */
    public function removePerson(\Skaphandrus\AppBundle\Entity\SkPerson $person)
    {
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }
}

