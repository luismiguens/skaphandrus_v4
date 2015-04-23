<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationCriteriaGroup
 */
class SkIdentificationCriteriaGroup
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    private $criteria;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationGroup
     */
    private $group;


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
     * Set criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     *
     * @return SkIdentificationCriteriaGroup
     */
    public function setCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria = null)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Set group
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group
     *
     * @return SkIdentificationCriteriaGroup
     */
    public function setGroup(\Skaphandrus\AppBundle\Entity\SkIdentificationGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationGroup
     */
    public function getGroup()
    {
        return $this->group;
    }
}

