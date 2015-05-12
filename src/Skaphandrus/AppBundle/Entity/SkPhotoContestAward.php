<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestAward
 */
class SkPhotoContestAward
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
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $winnerPhoto;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    private $contest;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $winnerFosUser;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $judge;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sponsor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->judge = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sponsor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContestAward
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
     * Set winnerPhoto
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $winnerPhoto
     *
     * @return SkPhotoContestAward
     */
    public function setWinnerPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $winnerPhoto = null)
    {
        $this->winnerPhoto = $winnerPhoto;

        return $this;
    }

    /**
     * Get winnerPhoto
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getWinnerPhoto()
    {
        return $this->winnerPhoto;
    }

    /**
     * Set contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     *
     * @return SkPhotoContestAward
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
     * Set winnerFosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $winnerFosUser
     *
     * @return SkPhotoContestAward
     */
    public function setWinnerFosUser(\Skaphandrus\AppBundle\Entity\FosUser $winnerFosUser = null)
    {
        $this->winnerFosUser = $winnerFosUser;

        return $this;
    }

    /**
     * Get winnerFosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getWinnerFosUser()
    {
        return $this->winnerFosUser;
    }

    /**
     * Set category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhotoContestAward
     */
    public function setCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     *
     * @return SkPhotoContestAward
     */
    public function addJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge)
    {
        $this->judge[] = $judge;

        return $this;
    }

    /**
     * Remove judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     */
    public function removeJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge)
    {
        $this->judge->removeElement($judge);
    }

    /**
     * Get judge
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJudge()
    {
        return $this->judge;
    }

    /**
     * Add sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     *
     * @return SkPhotoContestAward
     */
    public function addSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor)
    {
        $this->sponsor[] = $sponsor;

        return $this;
    }

    /**
     * Remove sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     */
    public function removeSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor)
    {
        $this->sponsor->removeElement($sponsor);
    }

    /**
     * Get sponsor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }
}

