<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContest
 */
class SkPhotoContest
{

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
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
    private $isJudge = '0';

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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkPhotoContest
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
     * Set logo
     *
     * @param string $logo
     *
     * @return SkPhotoContest
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContest
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
     * Set beginAt
     *
     * @param \DateTime $beginAt
     *
     * @return SkPhotoContest
     */
    public function setBeginAt($beginAt)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return SkPhotoContest
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set isJudge
     *
     * @param boolean $isJudge
     *
     * @return SkPhotoContest
     */
    public function setIsJudge($isJudge)
    {
        $this->isJudge = $isJudge;

        return $this;
    }

    /**
     * Get isJudge
     *
     * @return boolean
     */
    public function getIsJudge()
    {
        return $this->isJudge;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoContest
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Add category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhotoContest
     */
    public function addCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     */
    public function removeCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     *
     * @return SkPhotoContest
     */
    public function addSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor)
    {
        $this->sponsors[] = $sponsor;

        return $this;
    }

    /**
     * Remove sponsor
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor
     */
    public function removeSponsor(\Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor $sponsor)
    {
        $this->sponsors->removeElement($sponsor);
    }

    /**
     * Get sponsors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsors()
    {
        return $this->sponsors;
    }

    /**
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContest
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $judges;


    /**
     * Add judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     *
     * @return SkPhotoContest
     */
    public function addJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge)
    {
        $this->judges[] = $judge;

        return $this;
    }

    /**
     * Remove judge
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge
     */
    public function removeJudge(\Skaphandrus\AppBundle\Entity\SkPhotoContestJudge $judge)
    {
        $this->judges->removeElement($judge);
    }

    /**
     * Get judges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJudges()
    {
        return $this->judges;
    }
}
