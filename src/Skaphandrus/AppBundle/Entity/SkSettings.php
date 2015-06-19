<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkSettings
 */
class SkSettings
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var boolean
     */
    private $emailMessageAtOnce = '1';

    /**
     * @var boolean
     */
    private $emailCommentAtOnce = '1';

    /**
     * @var boolean
     */
    private $emailUpdate = '1';

    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $facebookUid;

    /**
     * @var string
     */
    private $observations;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime
     */
    private $emailNotificationTime;


    /**
     * Set language
     *
     * @param string $language
     *
     * @return SkSettings
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set emailMessageAtOnce
     *
     * @param boolean $emailMessageAtOnce
     *
     * @return SkSettings
     */
    public function setEmailMessageAtOnce($emailMessageAtOnce)
    {
        $this->emailMessageAtOnce = $emailMessageAtOnce;

        return $this;
    }

    /**
     * Get emailMessageAtOnce
     *
     * @return boolean
     */
    public function getEmailMessageAtOnce()
    {
        return $this->emailMessageAtOnce;
    }

    /**
     * Set emailCommentAtOnce
     *
     * @param boolean $emailCommentAtOnce
     *
     * @return SkSettings
     */
    public function setEmailCommentAtOnce($emailCommentAtOnce)
    {
        $this->emailCommentAtOnce = $emailCommentAtOnce;

        return $this;
    }

    /**
     * Get emailCommentAtOnce
     *
     * @return boolean
     */
    public function getEmailCommentAtOnce()
    {
        return $this->emailCommentAtOnce;
    }

    /**
     * Set emailUpdate
     *
     * @param boolean $emailUpdate
     *
     * @return SkSettings
     */
    public function setEmailUpdate($emailUpdate)
    {
        $this->emailUpdate = $emailUpdate;

        return $this;
    }

    /**
     * Get emailUpdate
     *
     * @return boolean
     */
    public function getEmailUpdate()
    {
        return $this->emailUpdate;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return SkSettings
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set facebookUid
     *
     * @param string $facebookUid
     *
     * @return SkSettings
     */
    public function setFacebookUid($facebookUid)
    {
        $this->facebookUid = $facebookUid;

        return $this;
    }

    /**
     * Get facebookUid
     *
     * @return string
     */
    public function getFacebookUid()
    {
        return $this->facebookUid;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return SkSettings
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return SkSettings
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
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
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkSettings
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null)
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

    /**
     * Set emailNotificationTime
     *
     * @param \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime $emailNotificationTime
     *
     * @return SkSettings
     */
    public function setEmailNotificationTime(\Skaphandrus\AppBundle\Entity\SkEmailNotificationTime $emailNotificationTime = null)
    {
        $this->emailNotificationTime = $emailNotificationTime;

        return $this;
    }

    /**
     * Get emailNotificationTime
     *
     * @return \Skaphandrus\AppBundle\Entity\SkEmailNotificationTime
     */
    public function getEmailNotificationTime()
    {
        return $this->emailNotificationTime;
    }
}

