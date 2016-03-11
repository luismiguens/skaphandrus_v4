<?php

namespace Skaphandrus\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var Collection
     */
    private $currency;

    /**
     * @var Collection
     */
    private $language;

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
    private $picture = 'business-profile.jpg';

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $premiumAt;

    /**
     * @var \DateTime
     */
    private $plusAt;

    /**
     * @var integer
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
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess
     */
    private $diveAccess;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $divePrice;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rentEquipment;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessGas
     */
    private $gas;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessSafety
     */
    private $safety;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessEducationConditions
     */
    private $educationConditions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $educationCourse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $spot;

    /**
     * @var Collection
     */
    private $type;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBusinessUnit
     */
    private $unit;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $admin;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkBooking
     */
    private $booking;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $otherActivity;

    /*     * symfony advanced forms
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
        $this->currency = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getAdminsEmails() {

        $emails = array();
        $fos_user = new FosUser();

        foreach ($this->getAdmin() as $key => $fos_user) {
            $emails[] = $fos_user->getEmail();
        }

        return $emails;
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

        if ($this->name):
            return $this->name;
        else:
            return "NULL";
        endif;
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

    /**
     * Add currency
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCurrency $currency
     *
     * @return SkPhoto
     */
    public function addCurrency(\Skaphandrus\AppBundle\Entity\SkCurrency $currency) {
        $this->currency[] = $currency;

        return $this;
    }

    /**
     * Remove currency
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCurrency $currency
     */
    public function removeCurrency(\Skaphandrus\AppBundle\Entity\SkCurrency $currency) {
        $this->currency->removeElement($currency);
    }

    /**
     * Get currency
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Add language
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLanguage $language
     *
     * @return SkPhoto
     */
    public function addLanguage(\Skaphandrus\AppBundle\Entity\SkLanguage $language) {
        $this->language[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \Skaphandrus\AppBundle\Entity\SkLanguage $language
     */
    public function removeLanguage(\Skaphandrus\AppBundle\Entity\SkLanguage $language) {
        $this->language->removeElement($language);
    }

    /**
     * Get language
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguage() {
        return $this->language;
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
     * Set premiumAt
     *
     * @param \DateTime $premiumAt
     *
     * @return SkBusiness
     */
    public function setPremiumAt($premiumAt) {
        $this->premiumAt = $premiumAt;

        return $this;
    }

    /**
     * Get premiumAt
     *
     * @return \DateTime
     */
    public function getPremiumAt() {
        return $this->premiumAt;
    }

    /**
     * Set plusAt
     *
     * @param \DateTime $plusAt
     *
     * @return SkBusiness
     */
    public function setPlusAt($plusAt) {
        $this->plusAt = $plusAt;

        return $this;
    }

    /**
     * Get plusAt
     *
     * @return \DateTime
     */
    public function getPlusAt() {
        return $this->plusAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
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
        $address->setBusiness($this);

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
        $contact->setBusiness($this);

        return $this;
    }

    /**
     * Get gas
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessGas
     */
    public function getGas() {
        return $this->gas;
    }

    /**
     * Set gas
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessGas $gas
     *
     * @return SkBusiness
     */
    public function setGas(\Skaphandrus\AppBundle\Entity\SkBusinessGas $gas = null) {
        $this->gas = $gas;
        $gas->setBusiness($this);

        return $this;
    }

    /**
     * Get safety
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessSafety
     */
    public function getSafety() {
        return $this->safety;
    }

    /**
     * Set safety
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessSafety $safety
     *
     * @return SkBusiness
     */
    public function setSafety(\Skaphandrus\AppBundle\Entity\SkBusinessSafety $safety = null) {
        $this->safety = $safety;
        $safety->setBusiness($this);

        return $this;
    }

    /**
     * Get educationConditions
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessEducationConditions
     */
    public function getEducationConditions() {
        return $this->educationConditions;
    }

    /**
     * Set educationConditions
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessEducationConditions $educationConditions
     *
     * @return SkBusiness
     */
    public function setEducationConditions(\Skaphandrus\AppBundle\Entity\SkBusinessEducationConditions $educationConditions = null) {
        $this->educationConditions = $educationConditions;
        $educationConditions->setBusiness($this);

        return $this;
    }

    /**
     * Add educationCourse
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessEducationCourse $educationCourse
     *
     * @return SkIdentificationCriteria
     */
    public function addEducationCourse(\Skaphandrus\AppBundle\Entity\SkBusinessEducationCourse $educationCourse) {
        $this->educationCourse[] = $educationCourse;
        $educationCourse->setBusiness($this);

        return $this;
    }

    /**
     * Remove educationCourse
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessEducationCourse $educationCourse
     */
    public function removeEducationCourse(\Skaphandrus\AppBundle\Entity\SkBusinessEducationCourse $educationCourse) {
        $this->educationCourse->removeElement($educationCourse);
    }

    /**
     * Get educationCourse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducationCourse() {
        return $this->educationCourse;
    }

    /**
     * Add rentEquipment
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessRentEquipment $rentEquipment
     *
     * @return SkIdentificationCriteria
     */
    public function addRentEquipment(\Skaphandrus\AppBundle\Entity\SkBusinessRentEquipment $rentEquipment) {
        $this->rentEquipment[] = $rentEquipment;
        $rentEquipment->setBusiness($this);

        return $this;
    }

    /**
     * Remove rentEquipment
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessRentEquipment $rentEquipment
     */
    public function removeRentEquipment(\Skaphandrus\AppBundle\Entity\SkBusinessRentEquipment $rentEquipment) {
        $this->rentEquipment->removeElement($rentEquipment);
    }

    /**
     * Get rentEquipment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentEquipment() {
        return $this->rentEquipment;
    }

    /**
     * Add divePrice
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $divePrice
     *
     * @return SkIdentificationCriteria
     */
    public function addDiveProuse(\Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $divePrice) {
        $this->divePrice[] = $divePrice;
        $divePrice->setBusiness($this);

        return $this;
    }

    /**
     * Remove divePrice
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $divePrice
     */
    public function removeDiveProuse(\Skaphandrus\AppBundle\Entity\SkBusinessDivePrice $divePrice) {
        $this->divePrice->removeElement($divePrice);
    }

    /**
     * Get divePrice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDivePrice() {
        return $this->divePrice;
    }

    /**
     * Get diveAccess
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess
     */
    public function getDiveAccess() {
        return $this->diveAccess;
    }

    /**
     * Set diveAccess
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess $diveAccess
     *
     * @return SkBusiness
     */
    public function setDiveAccess(\Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess $diveAccess = null) {
        $this->diveAccess = $diveAccess;
        $diveAccess->setBusiness($this);

        return $this;
    }

    /**
     * Add spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkBusiness
     */
    public function addSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot) {
        $this->spot[] = $spot;

        return $this;
    }

    /**
     * Remove spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     */
    public function removeSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot) {
        $this->spot->removeElement($spot);
    }

    /**
     * Get spot
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpot() {
        return $this->spot;
    }

    /**
     * Clear all spots
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     */
    public function clearSpots() {
        $this->spot->clear();
    }

    /**
     * Add admin
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $admin
     *
     * @return SkBusiness
     */
    public function addAdmin(\Skaphandrus\AppBundle\Entity\FosUser $admin) {
        $this->admin[] = $admin;

        return $this;
    }

    /**
     * Remove admin
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $admin
     */
    public function removeAdmin(\Skaphandrus\AppBundle\Entity\FosUser $admin) {
        $this->admin->removeElement($admin);
    }

    /**
     * Get admin
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * Clear all admins
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $admin
     */
    public function clearAdmins() {
        $this->admin->clear();
    }

    /**
     * Add type
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessType $type
     *
     * @return SkBusiness
     */
    public function addType(\Skaphandrus\AppBundle\Entity\SkBusinessType $type) {
        $this->type[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessType $type
     */
    public function removeType(\Skaphandrus\AppBundle\Entity\SkBusinessType $type) {
        $this->type->removeElement($type);
    }

    /**
     * Get type
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set unit
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBusinessUnit $unit
     *
     * @return SkBusiness
     */
    public function setUnit(\Skaphandrus\AppBundle\Entity\SkBusinessUnit $unit = null) {
        $this->unit = $unit;
        $unit->setBusiness($this);

        return $this;
    }

    /**
     * Get unit
     *
     * @return \Skaphandrus\AppBundle\Entity\SkBusinessUnit
     */
    public function getUnit() {
        return $this->unit;
    }

    /**
     * Add booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     *
     * @return SkIdentificationCriteria
     */
    public function addBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking) {
        $this->booking[] = $booking;
        $booking->setBusiness($this);

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \Skaphandrus\AppBundle\Entity\SkBooking $booking
     */
    public function removeBooking(\Skaphandrus\AppBundle\Entity\SkBooking $booking) {
        $this->booking->removeElement($booking);
    }

    /**
     * Get booking
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooking() {
        return $this->booking;
    }

    /**
     * Add otherActivity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity
     *
     * @return SkPhotoContestAward
     */
    public function addOtherActivity(\Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity) {
        $this->otherActivity[] = $otherActivity;

        return $this;
    }

    /**
     * Remove otherActivity
     *
     * @param \Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity
     */
    public function removeOtherActivity(\Skaphandrus\AppBundle\Entity\SkOtherActivity $otherActivity) {
        $this->otherActivity->removeElement($otherActivity);
    }

    /**
     * Get otherActivity
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOtherActivity() {
        return $this->otherActivity;
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

    public function isPremium() {

        $now = new \DateTime();

        if ($this->getPremiumAt() != null) {

            $diff = date_diff($now, $this->getPremiumAt());
//        dump($diff->y > 1); // « shows some properties.

            if ($diff->y < 1) {
                return true;
            }

            return false;
        }
    }

    public function isPlus() {

        $now = new \DateTime();

        if ($this->getPlusAt() != null) {

            $diff = date_diff($now, $this->getPlusAt());
//        dump($diff->y > 1); // « shows some properties.

            if ($diff->y < 1) {
                return true;
            }

            return false;
        }
    }

    public function isUserAdminFromBusiness(FosUser $user) {

        foreach ($this->getAdmin() as $admin) {

            if ($admin->getId() == $user->getId()):
                return true;
            endif;
        }

        return false;
    }

    public function doStuffOnPostLoad(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
//        $entity = new SkBusiness();

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

        if (!$entity->getUnit()) {
            $unit = new SkBusinessUnit();
            $unit->setBusiness($entity);

            $capacity = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitCapacity')->Find(1);
            $currency = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitCurrency')->Find(1);
            $length = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitLength')->Find(1);
            $pressure = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitPressure')->Find(1);
            $temperature = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitTemperature')->Find(1);
            $velocity = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitVelocity')->Find(1);
            $volume = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitVolume')->Find(1);
            $weight = $entityManager->getRepository('SkaphandrusAppBundle:SkUnitWeight')->Find(1);

            $unit->setCapacity($capacity);
            $unit->setCurrency($currency);
            $unit->setLength($length);
            $unit->setPressure($pressure);
            $unit->setTemperature($temperature);
            $unit->setVelocity($velocity);
            $unit->setVolume($volume);
            $unit->setWeight($weight);

            $entity->setUnit($unit);
            $entityManager->persist($unit);
        }
    }

}
