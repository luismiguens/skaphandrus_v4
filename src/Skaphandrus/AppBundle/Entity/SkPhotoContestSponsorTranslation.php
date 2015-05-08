<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestSponsorTranslation
 */
class SkPhotoContestSponsorTranslation
{

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $description;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkPhotoContestSponsorTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

