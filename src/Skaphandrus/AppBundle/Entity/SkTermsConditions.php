<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkTermsConditions
 */
class SkTermsConditions {

    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var \DateTime
     */
    private $applyAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct() {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set applyAt
     *
     * @param \DateTime $applyAt
     *
     * @return SkTermsConditions
     */
    public function setApplyAt($applyAt) {
        $this->applyAt = $applyAt;

        return $this;
    }

    /**
     * Get applyAt
     *
     * @return \DateTime
     */
    public function getApplyAt() {
        return $this->applyAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Add user
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $user
     *
     * @return SkTermsConditions
     */
    public function addUser(\Skaphandrus\AppBundle\Entity\FosUser $user) {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $user
     */
    public function removeUser(\Skaphandrus\AppBundle\Entity\FosUser $user) {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser() {
        return $this->user;
    }

    public function __toString() {
        return $this->getText();
    }

    public function getText() {
        return $this->translate()->getText();
    }

}
