<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestTranslation
 */
class SkPhotoContestTranslation
{

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $rules;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkPhotoContestTranslation
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

    /**
     * Set rules
     *
     * @param string $rules
     *
     * @return SkPhotoContestTranslation
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get rules
     *
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }
}

