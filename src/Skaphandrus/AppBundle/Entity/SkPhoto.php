<?php

namespace Skaphandrus\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * SkPhoto
 */
class SkPhoto {

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $views;

    /**
     * @var \DateTime
     */
    private $takenAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkCreativeCommons
     */
    private $creative;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel
     */
    private $model;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpot
     */
    private $spot;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $keyword;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct() {
        $this->keyword = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return SkPhoto
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhoto
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
     * Set description
     *
     * @param string $description
     *
     * @return SkPhoto
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return SkPhoto
     */
    public function setViews($views) {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews() {
        return $this->views;
    }

    /**
     * Set takenAt
     *
     * @param \DateTime $takenAt
     *
     * @return SkPhoto
     */
    public function setTakenAt($takenAt) {
        $this->takenAt = $takenAt;

        return $this;
    }

    /**
     * Get takenAt
     *
     * @return \DateTime
     */
    public function getTakenAt() {
        return $this->takenAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhoto
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
     * Set creative
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCreativeCommons $creative
     *
     * @return SkPhoto
     */
    public function setCreative(\Skaphandrus\AppBundle\Entity\SkCreativeCommons $creative = null) {
        $this->creative = $creative;

        return $this;
    }

    /**
     * Get creative
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCreativeCommons
     */
    public function getCreative() {
        return $this->creative;
    }

    /**
     * Set model
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel $model
     *
     * @return SkPhoto
     */
    public function setModel(\Skaphandrus\AppBundle\Entity\SkPhotoMachineModel $model = null) {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Set spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkPhoto
     */
    public function setSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot = null) {
        $this->spot = $spot;

        return $this;
    }

    /**
     * Get spot
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpot
     */
    public function getSpot() {
        return $this->spot;
    }

    /**
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkPhoto
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species = null) {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getSpecies() {
        return $this->species;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhoto
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser() {
        return $this->fosUser;
    }

    /**
     * Add keyword
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKeyword $keyword
     *
     * @return SkPhoto
     */
    public function addKeyword(\Skaphandrus\AppBundle\Entity\SkKeyword $keyword) {
        $this->keyword[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKeyword $keyword
     */
    public function removeKeyword(\Skaphandrus\AppBundle\Entity\SkKeyword $keyword) {
        $this->keyword->removeElement($keyword);
    }

    /**
     * Get keyword
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeyword() {
        return $this->keyword;
    }

    /**
     * Add category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhoto
     */
    public function addCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     */
    public function removeCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory() {
        return $this->category;
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
        return 'uploads';
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

    /**
     * 
     * @return type
     */
    public function upload() {
// the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

// use the original file name here but you should
// sanitize it at least to avoid any security issues
// move takes the target directory and then the
// target filename to move to
        $this->getFile()->move(
                $this->getUploadRootDir(), sha1(uniqid(mt_rand(), true)).'.'.$this->getFile()->guessExtension()
        );

// set the path property to the filename where you've saved the file
        $this->image = $this->getFile()->getClientOriginalName();

// clean up the file property as you won't need it anymore
        $this->file = null;
    }

    
    public function getKeywordsString() {
        $string = '';

        foreach ($this->keyword->toArray() as $keyword) {
            $string .= $keyword->getKeyword() . ', ';
        }

        return substr($string, 0, -2);
    }
    
    
    
    
    public function countComments() {
        
        return "123";
        
    }
    
    
    
    public function countLikes() {
        
        return "321";
        
    }
}
