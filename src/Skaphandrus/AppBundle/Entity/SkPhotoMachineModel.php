<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoMachineModel
 */
class SkPhotoMachineModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $megapixels;

    /**
     * @var string
     */
    private $zoomOptic;

    /**
     * @var string
     */
    private $modeExposition;

    /**
     * @var string
     */
    private $modeMetering;

    /**
     * @var string
     */
    private $iso;

    /**
     * @var string
     */
    private $whiteBalance;

    /**
     * @var string
     */
    private $focusMacro;

    /**
     * @var string
     */
    private $lcd;

    /**
     * @var string
     */
    private $memory;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoMachineBrand
     */
    private $brand;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkPhotoMachineModel
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
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoMachineModel
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SkPhotoMachineModel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set megapixels
     *
     * @param string $megapixels
     *
     * @return SkPhotoMachineModel
     */
    public function setMegapixels($megapixels)
    {
        $this->megapixels = $megapixels;

        return $this;
    }

    /**
     * Get megapixels
     *
     * @return string
     */
    public function getMegapixels()
    {
        return $this->megapixels;
    }

    /**
     * Set zoomOptic
     *
     * @param string $zoomOptic
     *
     * @return SkPhotoMachineModel
     */
    public function setZoomOptic($zoomOptic)
    {
        $this->zoomOptic = $zoomOptic;

        return $this;
    }

    /**
     * Get zoomOptic
     *
     * @return string
     */
    public function getZoomOptic()
    {
        return $this->zoomOptic;
    }

    /**
     * Set modeExposition
     *
     * @param string $modeExposition
     *
     * @return SkPhotoMachineModel
     */
    public function setModeExposition($modeExposition)
    {
        $this->modeExposition = $modeExposition;

        return $this;
    }

    /**
     * Get modeExposition
     *
     * @return string
     */
    public function getModeExposition()
    {
        return $this->modeExposition;
    }

    /**
     * Set modeMetering
     *
     * @param string $modeMetering
     *
     * @return SkPhotoMachineModel
     */
    public function setModeMetering($modeMetering)
    {
        $this->modeMetering = $modeMetering;

        return $this;
    }

    /**
     * Get modeMetering
     *
     * @return string
     */
    public function getModeMetering()
    {
        return $this->modeMetering;
    }

    /**
     * Set iso
     *
     * @param string $iso
     *
     * @return SkPhotoMachineModel
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set whiteBalance
     *
     * @param string $whiteBalance
     *
     * @return SkPhotoMachineModel
     */
    public function setWhiteBalance($whiteBalance)
    {
        $this->whiteBalance = $whiteBalance;

        return $this;
    }

    /**
     * Get whiteBalance
     *
     * @return string
     */
    public function getWhiteBalance()
    {
        return $this->whiteBalance;
    }

    /**
     * Set focusMacro
     *
     * @param string $focusMacro
     *
     * @return SkPhotoMachineModel
     */
    public function setFocusMacro($focusMacro)
    {
        $this->focusMacro = $focusMacro;

        return $this;
    }

    /**
     * Get focusMacro
     *
     * @return string
     */
    public function getFocusMacro()
    {
        return $this->focusMacro;
    }

    /**
     * Set lcd
     *
     * @param string $lcd
     *
     * @return SkPhotoMachineModel
     */
    public function setLcd($lcd)
    {
        $this->lcd = $lcd;

        return $this;
    }

    /**
     * Get lcd
     *
     * @return string
     */
    public function getLcd()
    {
        return $this->lcd;
    }

    /**
     * Set memory
     *
     * @param string $memory
     *
     * @return SkPhotoMachineModel
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Get memory
     *
     * @return string
     */
    public function getMemory()
    {
        return $this->memory;
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
     * Set brand
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoMachineBrand $brand
     *
     * @return SkPhotoMachineModel
     */
    public function setBrand(\Skaphandrus\AppBundle\Entity\SkPhotoMachineBrand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoMachineBrand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    
    
        public function __toString(){
        return $this->getName();
    }
    
    
}

