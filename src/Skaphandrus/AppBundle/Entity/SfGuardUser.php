<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SfGuardUser
 */
class SfGuardUser
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $algorithm = 'sha1';

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * @var boolean
     */
    private $isActive = '1';

    /**
     * @var boolean
     */
    private $isSuperAdmin = '0';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set username
     *
     * @param string $username
     *
     * @return SfGuardUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set algorithm
     *
     * @param string $algorithm
     *
     * @return SfGuardUser
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return string
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return SfGuardUser
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return SfGuardUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SfGuardUser
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
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return SfGuardUser
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return SfGuardUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isSuperAdmin
     *
     * @param boolean $isSuperAdmin
     *
     * @return SfGuardUser
     */
    public function setIsSuperAdmin($isSuperAdmin)
    {
        $this->isSuperAdmin = $isSuperAdmin;

        return $this;
    }

    /**
     * Get isSuperAdmin
     *
     * @return boolean
     */
    public function getIsSuperAdmin()
    {
        return $this->isSuperAdmin;
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

