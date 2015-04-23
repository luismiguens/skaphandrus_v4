<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkOrderVernacular
 */
class SkOrderVernacular
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkOrder
     */
    private $order;


    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return SkOrderVernacular
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkOrderVernacular
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
     * Set order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOrder $order
     *
     * @return SkOrderVernacular
     */
    public function setOrder(\Skaphandrus\AppBundle\Entity\SkOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Skaphandrus\AppBundle\Entity\SkOrder
     */
    public function getOrder()
    {
        return $this->order;
    }
}

