<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkIdentificationCriteria
 */
class SkIdentificationCriteria
{
    /**
     * @var string
     */
    private $orderBy;

    /**
     * @var boolean
     */
    private $isCumulative = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType
     */
    private $type;


    /**
     * Set orderBy
     *
     * @param string $orderBy
     *
     * @return SkIdentificationCriteria
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set isCumulative
     *
     * @param boolean $isCumulative
     *
     * @return SkIdentificationCriteria
     */
    public function setIsCumulative($isCumulative)
    {
        $this->isCumulative = $isCumulative;

        return $this;
    }

    /**
     * Get isCumulative
     *
     * @return boolean
     */
    public function getIsCumulative()
    {
        return $this->isCumulative;
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
     * Set type
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType $type
     *
     * @return SkIdentificationCriteria
     */
    public function setType(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaType
     */
    public function getType()
    {
        return $this->type;
    }
}

