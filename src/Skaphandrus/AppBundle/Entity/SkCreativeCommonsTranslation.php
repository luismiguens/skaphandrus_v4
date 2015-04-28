<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkCreativeCommonsTranslation
 */
class SkCreativeCommonsTranslation
{
    
        use ORMBehaviors\Translatable\Translation;
        
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkCreativeCommonsTranslation
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
     * Set url
     *
     * @param string $url
     *
     * @return SkCreativeCommonsTranslation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}

