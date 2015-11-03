<?php

namespace Skaphandrus\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

/**
 * SkBusiness
 */
class SkBusiness {

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $foundedAt;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $mission;

    /**
     * @var string
     */
    private $awards;

    /**
     * @var string
     */
    //nome da imagem
    private $picture;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */

    /**
     * id    
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkAddress
     */
    private $address;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkContact
     */
    private $contact;

    /**
     * file   
     */
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

    /**
     * Constructor
     */
    public function __construct() {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SkBusiness
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set foundedAt
     *
     * @param \DateTime $foundedAt
     *
     * @return SkBusiness
     */
    public function setFoundedAt($foundedAt) {
        $this->foundedAt = $foundedAt;

        return $this;
    }

    /**
     * Get foundedAt
     *
     * @return \DateTime
     */
    public function getFoundedAt() {
        return $this->foundedAt;
    }

//    /**
//     * Set currency
//     *
//     * @param string $currency
//     *
//     * @return SkBusiness
//     */
//    public function setCurrency($currency) {
//        $this->currency = $currency;
//
//        return $this;
//    }
//
//    /**
//     * Get currency
//     *
//     * @return string
//     */
//    public function getCurrency() {
//        return $this->currency;
//    }
    
    public function addCurrency($currency) {
        $this->currency[] = $currency;

        return $this;
    }

    
    public function removeCurrency($currency) {
        $this->currency->removeElement($currency);
    }

    
    public function getCurrency() {
        return $this->currency;
    }
    
    

    /**
     * Set about
     *
     * @param string $about
     *
     * @return SkBusiness
     */
    public function setAbout($about) {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout() {
        return $this->about;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkBusiness
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return SkBusiness
     */
    public function setMission($mission) {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return string
     */
    public function getMission() {
        return $this->mission;
    }

    /**
     * Set awards
     *
     * @param string $awards
     *
     * @return SkBusiness
     */
    public function setAwards($awards) {
        $this->awards = $awards;

        return $this;
    }

    /**
     * Get awards
     *
     * @return string
     */
    public function getAwards() {
        return $this->awards;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return SkBusiness
     */
    public function setPicture($picture) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkBusiness
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return SkBusiness
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Get address
     *
     * @return \Skaphandrus\AppBundle\Entity\SkAddress
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param \Skaphandrus\AppBundle\Entity\SkAddress $address
     *
     * @return SkBusiness
     */
    public function setAddress(\Skaphandrus\AppBundle\Entity\SkAddress $address = null) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Skaphandrus\AppBundle\Entity\SkContact
     */
    public function getContact() {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param \Skaphandrus\AppBundle\Entity\SkContact $contact
     *
     * @return SkBusiness
     */
    public function setContact(\Skaphandrus\AppBundle\Entity\SkContact $contact = null) {
        $this->contact = $contact;

        return $this;
    }

    public function getAbsolutePath() {
        return null === $this->picture ? null : $this->getUploadRootDir() . '/' . $this->picture;
    }

    public function getWebPath() {
        return null === $this->picture ? null : $this->getUploadDir() . '/' . $this->picture;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/business';
    }

    public function doStuffOnPostLoad(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $originalEntity = $entity;
        
        $entityManager = $args->getEntityManager();

        if (!$entity->getContact()) {
            $contact = new SkContact();
            $contact->setBusiness($entity);
            $entity->setContact($contact);
            $entityManager->persist($contact);
        }

        if (!$entity->getAddress()) {
            $address = new SkAddress();
            $address->setBusiness($entity);
            $entity->setAddress($address);
            $entityManager->persist($address);
        }

        if($originalEntity != $entity){
            $entityManager->persist($entity);
            $entityManager->flush();
        }
        
        
    }

}
