<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * SkIdentificationCharacter
 */
class SkIdentificationCharacter
{

    use ORMBehaviors\Translatable\Translatable;
    
    /**
     * @var string 
    */
    //nome da imagem
    private $image;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria
     */
    private $criteria;

//    private $file;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $phylum;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $order;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $family;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $genus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $class;
    
    
    private $imageFile;
    
    
    private $updatedAt;
    
    
    private $isFromSpecies = false;
    

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
        
          // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }


    public function __toString() {
        return $this->translate()->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->phylum = new \Doctrine\Common\Collections\ArrayCollection();
    }

    
        /**
     * Set isFromSpecies
     *
     * @param string $isFromSpecies
     *
     * @return SkIdentificationCharacter
     */
    public function setIsFromSpecies($isFromSpecies)
    {
        $this->isFromSpecies = $isFromSpecies;
        
       

        return $this;
    }

    /**
     * Get isFromSpecies
     *
     * @return string
     */
    public function getIsFromSpecies()
    {
        return $this->isFromSpecies;
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

//    /**
//     * Sets file.
//     *
//     * @param UploadedFile $file
//     */
//    public function setFile(UploadedFile $file = null)
//    {
//        $this->file = $file;
//    }
//
//    /**
//     * Get file.
//     *
//     * @return UploadedFile
//     */
//    public function getFile()
//    {
//        return $this->file;
//    }

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
        return 'uploads/characters';
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('file', new Assert\File(array(
            'maxSize' => 6000000,
        )));
    }

//    public function upload() {
//        // the file property can be empty if the field is not required
//        if (null === $this->getFile()) {
//            return;
//        }
//
//        $filename = sha1(uniqid(mt_rand(), true));
//            
//        $this->image = $filename.'.'.$this->getFile()->guessExtension();
//        
//        
//        // use the original file name here but you should
//        // sanitize it at least to avoid any security issues
//        // move takes the target directory and then the
//        // target filename to move to
////        $this->getFile()->move(
////                $this->getUploadRootDir(), sha1(uniqid(mt_rand(), true)).'.'.$this->getFile()->guessExtension()
////        );
//
//        $this->getFile()->move($this->getUploadRootDir(), $this->image);
//        
//        
//        // set the path property to the filename where you've saved the file
//        //$this->image = $this->getFile()->getClientOriginalName();
//        
//
//        // clean up the file property as you won't need it anymore
//        $this->file = null;
//    }

    /**
     * Add phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     *
     * @return SkIdentificationCharacter
     */
    public function addPhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum)
    {
        $this->phylum[] = $phylum;

        return $this;
    }

    /**
     * Remove phylum
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhylum $phylum
     */
    public function removePhylum(\Skaphandrus\AppBundle\Entity\SkPhylum $phylum)
    {
        $this->phylum->removeElement($phylum);
    }

    /**
     * Get phylum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Add species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $species
     *
     * @return SkIdentificationCharacter
     */
    public function addSpecy(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $species)
    {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove species
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $species
     */
    public function removeSpecy(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $species)
    {
        $this->species->removeElement($species);
    }

    /**
     * Get species
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Add order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $order
     *
     * @return SkIdentificationCharacter
     */
    public function addOrder(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $order
     */
    public function removeOrder(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     *
     * @return SkIdentificationCharacter
     */
    public function addFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family)
    {
        $this->family[] = $family;

        return $this;
    }

    /**
     * Remove family
     *
     * @param \Skaphandrus\AppBundle\Entity\SkFamily $family
     */
    public function removeFamily(\Skaphandrus\AppBundle\Entity\SkFamily $family)
    {
        $this->family->removeElement($family);
    }

    /**
     * Get family
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Add genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkIdentificationCharacter
     */
    public function addGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus)
    {
        $this->genus[] = $genus;

        return $this;
    }

    /**
     * Remove genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     */
    public function removeGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus)
    {
        $this->genus->removeElement($genus);
    }

    /**
     * Get genus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Add class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     *
     * @return SkIdentificationCharacter
     */
    public function addClass(\Skaphandrus\AppBundle\Entity\SkClass $class)
    {
        $this->class[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \Skaphandrus\AppBundle\Entity\SkClass $class
     */
    public function removeClass(\Skaphandrus\AppBundle\Entity\SkClass $class)
    {
        $this->class->removeElement($class);
    }

    /**
     * Get class
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClass()
    {
        return $this->class;
    }
}
