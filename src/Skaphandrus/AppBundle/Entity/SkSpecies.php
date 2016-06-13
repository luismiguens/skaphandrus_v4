<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkSpecies
 */
class SkSpecies {

    use ORMBehaviors\Translatable\Translatable;

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
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkGenus
     */
    private $genus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $character;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $species_vernaculars;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $illustrations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $scientific_names;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $image_refs;
    private $photosCount = 0;
    private $photosInSpecies;
    private $criterias;
    private $primaryPhoto;

    /**
     * Constructor
     */
    public function __construct() {
        $this->character = new \Doctrine\Common\Collections\ArrayCollection();
        $this->image_refs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setId($param) {
        $this->id = $param;
    }

    /**
     * Set primaryPhoto
     *
     * @param \DateTime $primaryPhoto
     *
     * @return SkSpecies
     */
    public function setPrimaryPhoto($primaryPhoto) {
        $this->primaryPhoto = $primaryPhoto;

        return $this;
    }

    /**
     * Get primaryPhoto
     *
     * @return \DateTime
     */
    public function getPrimaryPhoto() {
        return $this->primaryPhoto;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkSpecies
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
     * @return SkSpecies
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

    /**
     * Set genus
     *
     * @param \Skaphandrus\AppBundle\Entity\SkGenus $genus
     *
     * @return SkSpecies
     */
    public function setGenus(\Skaphandrus\AppBundle\Entity\SkGenus $genus = null) {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return \Skaphandrus\AppBundle\Entity\SkGenus
     */
    public function getGenus() {
        return $this->genus;
    }

    /**
     * Add character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     *
     * @return SkSpecies
     */
    public function addCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character) {
        $this->character[] = $character;

        return $this;
    }

    /**
     * Remove character
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character
     */
    public function removeCharacter(\Skaphandrus\AppBundle\Entity\SkIdentificationCharacter $character) {
        $this->character->removeElement($character);
    }

    /**
     * Get character
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacter() {
        return $this->character;
    }

    /**
     * Add criterias
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriterias $criteria
     *
     * @return SkSpecies
     */
    public function addCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria) {
        $this->criterias[] = $criteria;

        return $this;
    }

    /**
     * Remove criteria
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria
     */
    public function removeCriteria(\Skaphandrus\AppBundle\Entity\SkIdentificationCriteria $criteria) {
        $this->criterias->removeElement($criteria);
    }

    public function setCriterias($criterias) {
        $this->criterias = $criterias;
    }

    public function getCriterias() {

//        $character = new SkIdentificationCharacter();
//        
//        foreach ($this->getCharacter() as $key => $character) {
//            $criteria[]=$character->getCriteria();
//        }
        //$this->criterias = $criteria;

        return $this->criterias;
    }

    /**
     * Add speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     *
     * @return SkSpecies
     */
    public function addSpeciesVernacular(\Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular) {
        $this->species_vernaculars[] = $speciesVernacular;

        return $this;
    }

    /**
     * Remove speciesVernacular
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular
     */
    public function removeSpeciesVernacular(\Skaphandrus\AppBundle\Entity\SkSpeciesVernacular $speciesVernacular) {
        $this->species_vernaculars->removeElement($speciesVernacular);
    }

    /**
     * Get speciesVernaculars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeciesVernaculars() {
        return $this->species_vernaculars;
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photo
     *
     * @return SkSpecies
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos() {
        return $this->photos;
    }

    public function setPhotos($photos) {
        return $this->photos = $photos;
    }

    /**
     * Add illustration
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIllustrationSpecies $illustration
     *
     * @return SkSpecies
     */
    public function addIllustration(\Skaphandrus\AppBundle\Entity\SkSpeciesIllustration $illustration) {
        $this->illustrations[] = $illustration;

        return $this;
    }

    /**
     * Remove illustration
     *
     * @param \Skaphandrus\AppBundle\Entity\SkIllustrationSpecies $illustration
     */
    public function removeIllustration(\Skaphandrus\AppBundle\Entity\SkSpeciesIllustration $illustration) {
        $this->illustrations->removeElement($illustration);
    }

    /**
     * Get illustrations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIllustrations() {
        return $this->illustrations;
    }

    public function setIllustrations($illustrations) {
        return $this->illustrations = $illustrations;
    }

    /**
     * Add scientificName
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesScientificName $scientificName
     *
     * @return SkSpecies
     */
    public function addScientificName(\Skaphandrus\AppBundle\Entity\SkSpeciesScientificName $scientificName) {
        $this->scientific_names[] = $scientificName;

        return $this;
    }

    /**
     * Remove scientificName
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesScientificName $scientificName
     */
    public function removeScientificName(\Skaphandrus\AppBundle\Entity\SkSpeciesScientificName $scientificName) {
        $this->scientific_names->removeElement($scientificName);
    }

    /**
     * Get scientificNames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScientificNames() {
        return $this->scientific_names;
    }

    /**
     * Get Name
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getName() {
        return $this->scientific_names[0]->getName();
    }

    public function __toString() {
        return $this->getName();
    }

    public function getTaxonNodeName() {
        return "species";
    }

    public function getParentNode() {
        return $this->getGenus();
    }

    /**
     * Add imageRef
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesImageRef $imageRef
     *
     * @return SkSpecies
     */
    public function addImageRef(\Skaphandrus\AppBundle\Entity\SkSpeciesImageRef $imageRef) {
        $this->image_refs[] = $imageRef;
        $imageRef->setSpecies($this);

        return $this;
    }

    /**
     * Remove imageRef
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpeciesImageRef $imageRef
     */
    public function removeImageRef(\Skaphandrus\AppBundle\Entity\SkSpeciesImageRef $imageRef) {
        $this->image_refs->removeElement($imageRef);
    }

    /**
     * Get imageRefs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImageRefs() {
        return $this->image_refs;
    }

    public function getImageRef() {
        foreach ($this->image_refs as $ir) {
            if ($ir->getIsPrimary())
                return $ir;
        }
    }

    public function getPhotosCount() {
        return $this->photosCount;
    }

    public function setPhotosCount($photosCount) {
        $this->photosCount = $photosCount;
    }

    public function doStuffOnPostLoad(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
//        $entity = new SkSpecies();

        if (!$entity->translate()->getDescription()) {
            $entity->translate('pt')->setDescription('descrição');
            $entity->translate('en')->setDescription('description');

            // In order to persist new translations, call mergeNewTranslations method, before flush
            $entity->mergeNewTranslations();
        }

        //$entityManager->persist($entity);
        $entityManager->flush();
    }

    public function getPhotosInSpecies() {
        return $this->photosInSpecies;
    }

    public function setPhotosInSpecies($photosInSpecies) {
        $this->photosInSpecies = $photosInSpecies;
    }

}
