<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestJudge
 */
class SkPhotoContestJudge {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    private $contest;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    private $award;
//
//    /**
//     * Constructor
//     */
//    public function __construct() {
//        $this->award = new \Doctrine\Common\Collections\ArrayCollection();
//    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

//    /**
//     * Set contest
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
//     *
//     * @return SkPhotoContestJudge
//     */
//    public function setContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest = null) {
//        $this->contest = $contest;
//
//        return $this;
//    }
//
//    /**
//     * Get contest
//     *
//     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContest
//     */
//    public function getContest() {
//        return $this->contest;
//    }

    /**
     * Add contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     *
     * @return SkPhotoContestJudge
     */
    public function addContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest) {
        $this->contest[] = $contest;

        return $this;
    }

    /**
     * Remove contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     */
    public function removeContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest) {
        $this->contest->removeElement($contest);
    }

    /**
     * Get contest
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContest() {
        return $this->contest;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhotoContestJudge
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

//    /**
//     * Add award
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
//     *
//     * @return SkPhotoContestJudge
//     */
//    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
//        $this->award[] = $award;
//
//        return $this;
//    }
//
//    /**
//     * Remove award
//     *
//     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
//     */
//    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
//        $this->award->removeElement($award);
//    }
//
//    /**
//     * Get award
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getAward() {
//        return $this->award;
//    }

    public function __toString() {
        return $this->getFosUser()->getName();
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->translate()->getDescription();
    }

}
