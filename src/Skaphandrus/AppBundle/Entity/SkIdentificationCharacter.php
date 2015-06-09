<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkIdentificationCharacter
 */
class SkIdentificationCharacter
{

    use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @var string
     */
    private $image;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    private $criteria;

    private $file;


    public function __toString() {
        return $this->translate()->getName();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkIdentificationCharacter
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     *
     * @return SkIdentificationCharacter
     */
    public function setCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria = null)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
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
        return 'uploads';
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('file', new Assert\File(array(
            'maxSize' => 6000000,
        )));
    }

    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
                $this->getUploadRootDir(), sha1(uniqid(mt_rand(), true)).'.'.$this->getFile()->guessExtension()
        );

        // set the path property to the filename where you've saved the file
        $this->image = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
