<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\HttpFoundation\File\File;

/**
 * SkPhotoContestSponsor
 */
class SkPhotoContestSponsor {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $name;

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
    private $award;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    private $business;

    /**
     * Constructor
     */
    public function __construct() {
        $this->award = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContestSponsor
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
     * Set name
     *
     * @param string $name
     *
     * @return SkPhotoContestSponsor
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     *
     * @return SkPhotoContestSponsor
     */
    public function setContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest = null) {
        $this->contest = $contest;

        return $this;
    }

    /**
     * Get contest
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    public function getContest() {
        return $this->contest;
    }

    /**
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContestSponsor
     */
    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->award[] = $award;

        return $this;
    }

    /**
     * Remove award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     */
    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->award->removeElement($award);
    }

    /**
     * Get award
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAward() {
        return $this->award;
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
        return 'uploads/contests';
    }

    public function __toString() {
        if ($this->business) {
            return $this->business->getName();
        } else {
            return $this->getName();
        }
    }

    protected $imageFile;

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
     * Set business
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusiness $business
     *
     * @return SkAddress
     */
    public function setBusiness(\Skaphandrus\AppBundle\Entity\SkBusiness $business = null) {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusiness
     */
    public function getBusiness() {
        return $this->business;
    }

}
