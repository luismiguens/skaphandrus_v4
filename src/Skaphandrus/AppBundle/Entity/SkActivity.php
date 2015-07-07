<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkActivity
 */
class SkActivity
{
    
        /**
     * @var integer
     */
    private $id;

    
    /**
     * @var string
     */
    private $messageName;

    /**
     * @var integer
     */
    private $userFrom;

    /**
     * @var integer
     */
    private $speciesId;

    /**
     * @var integer
     */
    private $spotId;

    /**
     * @var integer
     */
    private $photoId;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $commentId;

    /**
     * @var integer
     */
    private $moduleId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var \DateTime
     */
    private $createdAt;


    /**
     * Set messageName
     *
     * @param string $messageName
     *
     * @return SkActivity
     */
    public function setMessageName($messageName)
    {
        $this->messageName = $messageName;

        return $this;
    }

    
        public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set userFrom
     *
     * @param integer $userFrom
     *
     * @return SkActivity
     */
    public function setUserFrom($userFrom)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return integer
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }

    /**
     * Set speciesId
     *
     * @param integer $speciesId
     *
     * @return SkActivity
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
     * Set spotId
     *
     * @param integer $spotId
     *
     * @return SkActivity
     */
    public function setSpotId($spotId)
    {
        $this->spotId = $spotId;

        return $this;
    }

    /**
     * Get spotId
     *
     * @return integer
     */
    public function getSpotId()
    {
        return $this->spotId;
    }

    /**
     * Set photoId
     *
     * @param integer $photoId
     *
     * @return SkActivity
     */
    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;

        return $this;
    }

    /**
     * Get photoId
     *
     * @return integer
     */
    public function getPhotoId()
    {
        return $this->photoId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return SkActivity
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
     * Set commentId
     *
     * @param integer $commentId
     *
     * @return SkActivity
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * Get commentId
     *
     * @return integer
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
     * @return SkActivity
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return SkActivity
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkActivity
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

}
