<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestCategory
 */
class SkPhotoContestCategory
{

    use ORMBehaviors\Translatable\Translatable;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $awards;
    
    
    /**
     * var used to save winner photos in category
     * @var type 
     */
    private $winnerPhotos;
    
    
    
    
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    
        public function setWinnerPhotos($winnerPhotos)
    {
        $this->winnerPhotos = $winnerPhotos;

        return $this;
    }

    /**
     * Get winnerPhotos
     *
     * @return string
     */
    public function getWinnerPhotos()
    {
        return $this->winnerPhotos;
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

    /**
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContestCategory
     */
    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award)
    {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * Remove award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     */
    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award)
    {
        $this->awards->removeElement($award);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwards()
    {
        return $this->awards;
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
        return 'uploads/fotografias';
    }
    
    
    public function __toString() {
        return $this->getName();
    }
    
    public function getCategoryJoinContestString() {
        return $this->getName()." » ".$this->getContest();
    }

    public function getName() {
        return $this->translate()->getName();
        
    }
    
}
