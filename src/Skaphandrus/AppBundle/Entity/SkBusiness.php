<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkBusiness
 */
class SkBusiness
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $foundedAt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $mission;

    /**
     * @var string
     */
    private $awards;

    /**
     * @var string
     */
    private $picture;

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
     * Set name
     *
     * @param string $name
     *
     * @return SkBusiness
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
     * Set foundedAt
     *
     * @param \DateTime $foundedAt
     *
     * @return SkBusiness
     */
    public function setFoundedAt($foundedAt)
    {
        $this->foundedAt = $foundedAt;

        return $this;
    }

    /**
     * Get foundedAt
     *
     * @return \DateTime
     */
    public function getFoundedAt()
    {
        return $this->foundedAt;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return SkBusiness
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return SkBusiness
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkBusiness
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return SkBusiness
     */
    public function setMission($mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return string
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set awards
     *
     * @param string $awards
     *
     * @return SkBusiness
     */
    public function setAwards($awards)
    {
        $this->awards = $awards;

        return $this;
    }

    /**
     * Get awards
     *
     * @return string
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return SkBusiness
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkBusiness
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
     * @return SkBusiness
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
}

