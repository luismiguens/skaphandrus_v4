<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkLocationTranslation
 */
class SkLocationTranslation
{

    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $waterTemp;

    /**
     * @var string
     */
    private $suit;

    /**
     * @var string
     */
    private $visibility;

    /**
     * @var string
     */
    private $climate;

    /**
     * @var string
     */
    private $howToGo;

    /**
     * @var string
     */
    private $extraDive;

    /**
     * @var integer
     */
    private $translatable_id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkLocationTranslation
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
     * Set description
     *
     * @param string $description
     *
     * @return SkLocationTranslation
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
     * Set waterTemp
     *
     * @param string $waterTemp
     *
     * @return SkLocationTranslation
     */
    public function setWaterTemp($waterTemp)
    {
        $this->waterTemp = $waterTemp;

        return $this;
    }

    /**
     * Get waterTemp
     *
     * @return string
     */
    public function getWaterTemp()
    {
        return $this->waterTemp;
    }

    /**
     * Set suit
     *
     * @param string $suit
     *
     * @return SkLocationTranslation
     */
    public function setSuit($suit)
    {
        $this->suit = $suit;

        return $this;
    }

    /**
     * Get suit
     *
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Set visibility
     *
     * @param string $visibility
     *
     * @return SkLocationTranslation
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set climate
     *
     * @param string $climate
     *
     * @return SkLocationTranslation
     */
    public function setClimate($climate)
    {
        $this->climate = $climate;

        return $this;
    }

    /**
     * Get climate
     *
     * @return string
     */
    public function getClimate()
    {
        return $this->climate;
    }

    /**
     * Set howToGo
     *
     * @param string $howToGo
     *
     * @return SkLocationTranslation
     */
    public function setHowToGo($howToGo)
    {
        $this->howToGo = $howToGo;

        return $this;
    }

    /**
     * Get howToGo
     *
     * @return string
     */
    public function getHowToGo()
    {
        return $this->howToGo;
    }

    /**
     * Set extraDive
     *
     * @param string $extraDive
     *
     * @return SkLocationTranslation
     */
    public function setExtraDive($extraDive)
    {
        $this->extraDive = $extraDive;

        return $this;
    }

    /**
     * Get extraDive
     *
     * @return string
     */
    public function getExtraDive()
    {
        return $this->extraDive;
    }

    /**
     * Set translatableId
     *
     * @param integer $translatableId
     *
     * @return SkLocationTranslation
     */
    public function setTranslatableId($translatableId)
    {
        $this->translatable_id = $translatableId;

        return $this;
    }

    /**
     * Get translatableId
     *
     * @return integer
     */
    public function getTranslatableId()
    {
        return $this->translatable_id;
    }
}
