<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestSponsor
 */
class SkPhotoContestSponsor
{

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
     * Constructor
     */
    public function __construct()
    {
        $this->award = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContestSponsor
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
     * Set name
     *
     * @param string $name
     *
     * @return SkPhotoContestSponsor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return SkPhotoContestSponsor
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
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContestSponsor
     */
    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award)
    {
        $this->award[] = $award;

        return $this;
    }

    /**
     * Remove award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     */
    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award)
    {
        $this->award->removeElement($award);
    }

    /**
     * Get award
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAward()
    {
        return $this->award;
    }
}

