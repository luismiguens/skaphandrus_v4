<?php

namespace Skaphandrus\AppBundle\Entity;

//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * SkSpeciesIllustration
 */
class SkSpeciesIllustration {
    /**
     * @var string
     */
    //nome da Imagem
    private $image;


    /**
     * @var integer
     */
    private $id;


    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;

    private $imageFile;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null) {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }

    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhoto
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }


    public function setId($param) {

        $this->id = $param;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpecies $species
     *
     * @return SkPhoto
     */
    public function setSpecies(\Skaphandrus\AppBundle\Entity\SkSpecies $species = null) {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    public function getSpecies() {
        return $this->species;
    }


    public function getAbsolutePath() {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath() {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir() {
// the absolute directory path where uploaded
// documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
// get rid of the __DIR__ so it doesn't screw up
// when displaying uploaded doc/image in the view.
        return 'uploads/ilustrations';
    }

}
