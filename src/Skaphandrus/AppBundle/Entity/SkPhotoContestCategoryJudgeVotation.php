<?php

namespace Skaphandrus\AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;

/**
 * SkPhotoContestCategoryJudgeVotation
 */
class SkPhotoContestCategoryJudgeVotation {

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var SkPhotoContestJudge
     */
    private $judge;

    /**
     * @var SkPhotoContestCategory
     */
    private $category;

    /**
     * @var Collection
     */
    private $judgeVote;

    public function __construct() {
        $this->updatedAt = new DateTime;
        $this->createdAt = new DateTime;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     *
     * @return SkPhotoContestCategoryJudgeVotation
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param DateTime $updatedAt
     *
     * @return SkPhotoContestCategoryJudgeVotation
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
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
     * Set judge
     *
     * @param SkPhotoContestJudge $judge
     *
     * @return SkPhotoContestCategoryJudgeVotation
     */
    public function setJudge(SkPhotoContestJudge $judge = null) {
        $this->judge = $judge;

        return $this;
    }

    /**
     * Get judge
     *
     * @return SkPhotoContestJudge
     */
    public function getJudge() {
        return $this->judge;
    }

    /**
     * Set category
     *
     * @param SkPhotoContestCategory $category
     *
     * @return SkPhotoContestCategoryJudgeVotation
     */
    public function setCategory(SkPhotoContestCategory $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return SkPhotoContestCategory
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Add judgeVote
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSkPhotoContestCategoryJudgePhotoVote $judgeVote
     *
     * @return 
     */
    public function addJudgeVote(SkPhotoContestCategoryJudgePhotoVote $judgeVote) {
        $this->judgeVote[] = $judgeVote;
        $judgeVote->setVotation($this);

        return $this;
    }

    /**
     * Remove judgeVote
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSkPhotoContestCategoryJudgePhotoVote $judgeVote
     */
    public function removeJudgeVote(SkPhotoContestCategoryJudgePhotoVote $judgeVote) {
        $this->judgeVote->removeElement($judgeVote);
    }

    /**
     * Get judgeVote
     *
     * @return Collection
     */
    public function getJudgeVote() {
        return $this->judgeVote;
    }

}
