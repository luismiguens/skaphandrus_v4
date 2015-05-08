<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestJudgeTranslation
 */
class SkPhotoContestJudgeTranslation
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
     * @return SkPhotoContestJudgeTranslation
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

