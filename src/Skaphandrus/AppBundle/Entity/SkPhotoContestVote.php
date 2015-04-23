<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestVote
 */
class SkPhotoContestVote
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    private $category;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoContestVote
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
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoContestVote
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhotoContestVote
     */
    public function setCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhotoContestVote
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
}

