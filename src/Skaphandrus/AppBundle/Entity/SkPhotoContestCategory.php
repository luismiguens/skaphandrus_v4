<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestCategory
 */
class SkPhotoContestCategory
{
    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    private $contest;

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
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContestCategory
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
     * Set contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     *
     * @return SkPhotoContestCategory
     */
    public function setContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest = null)
    {
        $this->contest = $contest;

        return $this;
    }

    /**
     * Get contest
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    public function getContest()
    {
        return $this->contest;
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoContestCategory
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

