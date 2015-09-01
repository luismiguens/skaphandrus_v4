<?php

//

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\HttpFoundation\File\File;

/**
 * SkPhotoContest
 */
class SkPhotoContest {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    //nome do logoTipo
    private $logo;

    /**
     * @var string
     */
    //nome da Imagem
    private $image;

    /**
     * @var \DateTime
     */
    private $beginAt;

    /**
     * @var \DateTime
     */
    private $endAt;

    /**
     * @var boolean
     */
    private $isJudge = false;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsors;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $awards;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $judges;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photographers;
    
    /**
     * @var boolean
     */
    private $isVisible = false;     


    protected $imageFile;
    protected $logoTipo;
    
    
    /**
     * Set visible
     *
     * @param boolean visible
     *
     * @return SkPhotoContest
     */
    public function setIsVisible($isVisible) {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getIsVisible() {
        return $this->isVisible;
    }
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
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }
       
    
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setlogoTipo(File $image = null) {
        $this->logoTipo = $image;
    }

    /**
     * @return File
     */
    public function getlogoTipo() {
        return $this->logoTipo;
    }
    

    public function getAbsolutePath() {
        return null === $this->logo ? null : $this->getUploadRootDir() . '/' . $this->logo;
    }

    public function getWebPath() {
        return null === $this->logo ? null : $this->getUploadDir() . '/' . $this->logo;
    }

    protected function getUploadRootDir() {
// the absolute directory path where uploaded
// documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
// get rid of the __DIR__ so it doesn't screw up
// when displaying uploaded doc/image in the view.
        return 'uploads/contests';
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkPhotoContest
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return SkPhotoContest
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo() {
        return $this->logo;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContest
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
     * Set beginAt
     *
     * @param \DateTime $beginAt
     *
     * @return SkPhotoContest
     */
    public function setBeginAt($beginAt) {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt() {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return SkPhotoContest
     */
    public function setEndAt($endAt) {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt() {
        return $this->endAt;
    }

    /**
     * Set isJudge
     *
     * @param boolean $isJudge
     *
     * @return SkPhotoContest
     */
    public function setIsJudge($isJudge) {
        $this->isJudge = $isJudge;

        return $this;
    }

    /**
     * Get isJudge
     *
     * @return boolean
     */
    public function getIsJudge() {
        return $this->isJudge;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoContest
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
     * Add category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhotoContest
     */
    public function addCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     */
    public function removeCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Add sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     *
     * @return SkPhotoContest
     */
    public function addSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor) {
        $this->sponsors[] = $sponsor;

        return $this;
    }

    /**
     * Remove sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     */
    public function removeSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor) {
        $this->sponsors->removeElement($sponsor);
    }

    /**
     * Get sponsors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsors() {
        foreach ($this->categories as $category) {
            foreach ($category->getAwards() as $award) {
                return $award->getSponsor();
            }
        }
    }

    /**
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContest
     */
    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * Remove award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     */
    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->awards->removeElement($award);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwards() {
        foreach ($this->categories as $category) {
            return $category->getAwards();
        }
    }

    /**
     * Add judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     *
     * @return SkPhotoContest
     */
    public function addJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge) {
        $this->judges[] = $judge;

        return $this;
    }

    /**
     * Remove judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     */
    public function removeJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge) {
        $this->judges->removeElement($judge);
    }

    /**
     * Get judges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJudges() {
        foreach ($this->categories as $category) {
            foreach ($category->getAwards() as $award) {
                return $award->getJudge();
            }
        }
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos() {

        $photos = array();
        $category = new SkPhotoContestCategory();

        foreach ($this->getCategories() as $category) {
            foreach ($category->getPhoto() as $photo ) {
                $photos [] = $photo;
            } 
        }
        $this->photos = $photos;
        return $this->photos;
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotographers() {

        $photographers = array();
        $category = new SkPhotoContestCategory();
        $photo = new SkPhoto();

        foreach ($this->getCategories() as $category) {
            foreach ($category->getPhoto() as $photo) {
                $photographers[]= $photo->getFosUser();
            }
        }
        
//        $this->photographers=$photographers;    
        $this->photographers = array_unique($photographers);
        return $this->photographers;
    }
    

    public function __toString() {
        return $this->getName();
    }

}
