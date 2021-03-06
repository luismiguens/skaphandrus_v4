<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSocialNotify
 */
class SkSocialNotify
{
    /**
     * @var string
     */
    private $messageName;

    /**
     * @var integer
     */
    private $speciesId;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $moduleId;

    /**
     * @var boolean
     */
    private $isRead = '0';

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\Comment
     */
    private $comment;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpot
     */
    private $spot;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosMessage
     */
    private $message;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $userTo;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $userFrom;


    /**
     * Set messageName
     *
     * @param string $messageName
     *
     * @return SkSocialNotify
     */
    public function setMessageName($messageName)
    {
        $this->messageName = $messageName;

        return $this;
    }

    /**
     * Get messageName
     *
     * @return string
     */
    public function getMessageName()
    {
        return $this->messageName;
    }

    /**
     * Set speciesId
     *
     * @param integer $speciesId
     *
     * @return SkSocialNotify
     */
    public function setSpeciesId($speciesId)
    {
        $this->speciesId = $speciesId;

        return $this;
    }

    /**
     * Get speciesId
     *
     * @return integer
     */
    public function getSpeciesId()
    {
        return $this->speciesId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return SkSocialNotify
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
     * @return SkSocialNotify
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return SkSocialNotify
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkSocialNotify
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param \Skaphandrus\AppBundle\Entity\Comment $comment
     *
     * @return SkSocialNotify
     */
    public function setComment(\Skaphandrus\AppBundle\Entity\Comment $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \Skaphandrus\AppBundle\Entity\Comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkSocialNotify
     */
    public function setSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot = null)
    {
        $this->spot = $spot;

        return $this;
    }

    /**
     * Get spot
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpot
     */
    public function getSpot()
    {
        return $this->spot;
    }

    /**
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkSocialNotify
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo = null)
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
     * Set message
     *
     * @param \Skaphandrus\AppBundle\Entity\FosMessage $message
     *
     * @return SkSocialNotify
     */
    public function setMessage(\Skaphandrus\AppBundle\Entity\FosMessage $message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \Skaphandrus\AppBundle\Entity\FosMessage
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set userTo
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $userTo
     *
     * @return SkSocialNotify
     */
    public function setUserTo(\Skaphandrus\AppBundle\Entity\FosUser $userTo = null)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getUserTo()
    {
        return $this->userTo;
    }

    /**
     * Set userFrom
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $userFrom
     *
     * @return SkSocialNotify
     */
    public function setUserFrom(\Skaphandrus\AppBundle\Entity\FosUser $userFrom = null)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }
}

