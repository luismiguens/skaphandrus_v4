<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * SkIdentificationModule
 */
class SkIdentificationModule {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $appstoreId;

    /**
     * @var string
     */
    private $googleplayId;

    /**
     * @var boolean
     */
    private $isActive = FALSE;

    /**
     * @var boolean
     */
    private $isEnabled = FALSE;

    /**
     * @var boolean
     */
    private $isFree = FALSE;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    private $master;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species;
    private $file;
    
    private $acquisitions;
    
    private $points;

    private $users;
    
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->acquisitions = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    public function getSpecies() {

        $species = array();
        foreach ($this->getGroups() as $group) {
            if ($group->getIsParentModule()) {
                $species = array_merge($species, $group->getTaxonValue()->getSpecies()->toArray());
            }
        }

        $this->species = $species;
        return $this->species;
    }

    /**
     * Set appstoreId
     *
     * @param string $appstoreId
     *
     * @return SkIdentificationModule
     */
    public function setAppstoreId($appstoreId) {
        $this->appstoreId = $appstoreId;

        return $this;
    }

    /**
     * Get appstoreId
     *
     * @return string
     */
    public function getAppstoreId() {
        return $this->appstoreId;
    }
    
    

    

    /**
     * Set googleplayId
     *
     * @param string $googleplayId
     *
     * @return SkIdentificationModule
     */
    public function setGoogleplayId($googleplayId) {
        $this->googleplayId = $googleplayId;

        return $this;
    }

    /**
     * Get googleplayId
     *
     * @return string
     */
    public function getGoogleplayId() {
        return $this->googleplayId;
    }

    /**
     * Set isActive
     * 
     * Metodo que controla se o modulo está concluido no lado do servidor.
     * 
     *
     * @param boolean $isActive
     *
     * @return SkIdentificationModule
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set isEnabled
     * 
     * Metodo que controla se o utilizador tem acesso ao modulo, por pontos, por ser gratuito ou por ter comprado.
     * is_enabled = 0 = “Will be available soon! New groups are added frequently so stay tuned!”,
     * is_enabled = -1 = “You don’t have access!”
     * is_enabled = 1 = “Have access!”
     *
     * @param boolean $isEnabled
     *
     * @return SkIdentificationModule
     */
    public function setIsEnabled($isEnabled) {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsEnabled() {
        return $this->isEnabled;
    }

    /**
     * Set isFree
     *
     * @param boolean $isFree
     *
     * @return SkIdentificationModule
     */
    public function setIsFree($isFree) {
        $this->isFree = $isFree;

        return $this;
    }

    /**
     * Get isFree
     *
     * @return boolean
     */
    public function getIsFree() {
        return $this->isFree;
    }

    
    /**
     * Set isFree
     *
     * @param boolean $isFree
     *
     * @return SkIdentificationModule
     */
    public function setPoints($points) {
        $this->points = $points;

        return $this;
    }

    /**
     * Get isFree
     *
     * @return boolean
     */
    public function getPoints() {
        
               
        if($this->getIsFree()){
            $this->points = 0;
        }else{
            $this->points = count($this->getSpecies());
        }
        
        return $this->points;
    }

    
        /**
     * Get isFree
     *
     * @return boolean
     */
    public function getPointsName() {
        
               
        if($this->getPoints()==0){
            return "is_free";
        }else{
            return $this->getPoints();
        }
        
        
    }
    
    
    
    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkIdentificationModule
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkIdentificationModule
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set master
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationMaster $master
     *
     * @return SkIdentificationModule
     */
    public function setMaster(\Skaphandrus\AppBundle\Entity\SkIdentificationMaster $master = null) {
        $this->master = $master;

        return $this;
    }

    /**
     * Get master
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationMaster
     */
    public function getMaster() {
        return $this->master;
    }

    public function getName() {
        return $this->translate()->getName();
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Add group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     *
     * @return FosUser
     */
    public function addGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group) {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     */
    public function removeGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group) {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }

    public function getAbsolutePath() {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath() {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/characters';
    }

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

    /**
     * 
     * @return type
     */
    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        $filename = sha1(uniqid(mt_rand(), true));

        $this->image = $filename . '.' . $this->getFile()->guessExtension();


        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the
        // target filename to move to
//        $this->getFile()->move(
//                $this->getUploadRootDir(), sha1(uniqid(mt_rand(), true)).'.'.$this->getFile()->guessExtension()
//        );

        $this->getFile()->move($this->getUploadRootDir(), $this->image);


        // set the path property to the filename where you've saved the file
        //$this->image = $this->getFile()->getClientOriginalName();
        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    
    
    
        /**
     * Add acquisition
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition
     *
     * @return SkIdentificationAcquisition
     */
    public function addAcquisition(\Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition) {
        $this->acquisitions[] = $acquisition;
    }
    
      
     /* * Remove acquisition
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition
     */
    public function removeAcquisition(\Skaphandrus\AppBundle\Entity\SkIdentificationAcquisition $acquisition)
    {
        $this->acquisitions->removeElement($acquisition);
    }

    /**
     * Get acquisitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcquisitions()
    {
        return $this->acquisitions;
    }
    
    
    
    /**
     * Add user
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $user
     *
     * @return SkIdentificationModule
     */
    public function addUser(\Skaphandrus\AppBundle\Entity\FosUser $user)
    {
        $this->users[] = $user;

        return $this;
    }

    
    
      /* * Remove user
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $user
     */
    public function removeUser(\Skaphandrus\AppBundle\Entity\FosUser $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    
}
