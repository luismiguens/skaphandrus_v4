<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkKeyword
 */
class SkKeyword
{
    /**
     * @var string
     */
    private $keyword;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return SkKeyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
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
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkKeyword
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo)
    {
        $this->photo[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo)
    {
        $this->photo->removeElement($photo);
    }

    /**
     * Get photo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}

