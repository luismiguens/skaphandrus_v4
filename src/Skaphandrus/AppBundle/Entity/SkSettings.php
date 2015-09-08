<?php

namespace Skaphandrus\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

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
    //nome da photo
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

    
    private $imageFile;


    private $updatedAt;
    
    
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null) {
 
        $this->imageFile = $image;
                
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }
    
    

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
        //         return ( $this->photo == "" ) ? 'user-profile.jpg' : 'user-profile.jpg';
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
    
    
    
    public function getAbsolutePath() {
        return null === $this->photo ? null : $this->getUploadRootDir() . '/' . $this->photo;
    }

    public function getWebPath() {
        return null === $this->photo ? null : $this->getUploadDir() . '/' . $this->photo;
    }

    protected function getUploadRootDir() {
// the absolute directory path where uploaded
// documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
// get rid of the __DIR__ so it doesn't screw up
// when displaying uploaded doc/image in the view.
        return 'uploads/utilizadores';
    }

    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

//    /**
//     * 
//     * @return type
//     */
//   public function upload() {
//        // the file property can be empty if the field is not required
//        if (null === $this->getFile()) {
//            return;
//        }
//
//        $filename = sha1(uniqid(mt_rand(), true));
//            
//        $this->photo = $filename.'.'.$this->getFile()->guessExtension();
//        
//        
//        // use the original file name here but you should
//        // sanitize it at least to avoid any security issues
//        // move takes the target directory and then the
//        // target filename to move to
////        $this->getFile()->move(
////                $this->getUploadRootDir(), sha1(uniqid(mt_rand(), true)).'.'.$this->getFile()->guessExtension()
////        );
//
//        $this->getFile()->move($this->getUploadRootDir(), $this->photo);
//        
//        
//        // set the path property to the filename where you've saved the file
//        //$this->image = $this->getFile()->getClientOriginalName();
//        
//
//        // clean up the file property as you won't need it anymore
//        $this->file = null;
//    }
    
    
}
