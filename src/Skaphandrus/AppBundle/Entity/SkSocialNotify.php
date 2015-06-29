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
    private $paramFirst;

    /**
     * @var integer
     */
    private $paramSecond;

    /**
     * @var integer
     */
    private $paramThird;

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
     * Set paramFirst
     *
     * @param integer $paramFirst
     *
     * @return SkSocialNotify
     */
    public function setParamFirst($paramFirst)
    {
        $this->paramFirst = $paramFirst;

        return $this;
    }

    /**
     * Get paramFirst
     *
     * @return integer
     */
    public function getParamFirst()
    {
        return $this->paramFirst;
    }

    /**
     * Set paramSecond
     *
     * @param integer $paramSecond
     *
     * @return SkSocialNotify
     */
    public function setParamSecond($paramSecond)
    {
        $this->paramSecond = $paramSecond;

        return $this;
    }

    /**
     * Get paramSecond
     *
     * @return integer
     */
    public function getParamSecond()
    {
        return $this->paramSecond;
    }

    /**
     * Set paramThird
     *
     * @param integer $paramThird
     *
     * @return SkSocialNotify
     */
    public function setParamThird($paramThird)
    {
        $this->paramThird = $paramThird;

        return $this;
    }

    /**
     * Get paramThird
     *
     * @return integer
     */
    public function getParamThird()
    {
        return $this->paramThird;
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

