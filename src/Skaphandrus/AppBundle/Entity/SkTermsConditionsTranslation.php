<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkTermsConditionsTranslation
 */
class SkTermsConditionsTranslation {
    
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $text;

    /**
     * Set text
     *
     * @param string $text
     *
     * @return SkTermsConditionsTranslation
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }

}
