<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestCategoryJudgePhotoVote
 */
class SkPhotoContestCategoryJudgePhotoVote
{
    /**
     * @var integer
     */
    private $points;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation
     */
    private $votation;


    /**
     * Set points
     *
     * @param integer $points
     *
     * @return SkPhotoContestCategoryJudgePhotoVote
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
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoContestCategoryJudgePhotoVote
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set votation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation $votation
     *
     * @return SkPhotoContestCategoryJudgePhotoVote
     */
    public function setVotation(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation $votation = null)
    {
        $this->votation = $votation;

        return $this;
    }

    /**
     * Get votation
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation
     */
    public function getVotation()
    {
        return $this->votation;
    }
}

