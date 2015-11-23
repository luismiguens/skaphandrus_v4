<?php

namespace Skaphandrus\AppBundle\Entity;

//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * SkPhoto
 */
class SkPhoto {

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    //nome da Imagem
    private $image;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $views;

    /**
     * @var \DateTime
     */
    private $takenAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkCreativeCommons
     */
    private $creative;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel
     */
    private $model;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpot
     */
    private $spot;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkSpecies
     */
    private $species;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $keyword;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $category;
    private $isValidated = '0';

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $speciesValidations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $speciesSugestions;
    private $imageFile;

    /**
     * var used in photo contests results
     * @var type 
     */
    private $points;

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
        $this->keyword = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->speciesValidations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->speciesSugestions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->takenAt = new \DateTime();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return SkPhoto
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set points
     *
     * @param string $points
     *
     * @return SkPhoto
     */
    public function setPoints($points) {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return string
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function __toString() {
        return $this->title;
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SkPhoto
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
     * Set views
     *
     * @param integer $views
     *
     * @return SkPhoto
     */
    public function setViews($views) {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews() {
        return $this->views;
    }

    /**
     * Set takenAt
     *
     * @param \DateTime $takenAt
     *
     * @return SkPhoto
     */
    public function setTakenAt($takenAt) {
        $this->takenAt = $takenAt;

        return $this;
    }

    /**
     * Get takenAt
     *
     * @return \DateTime
     */
    public function getTakenAt() {
        return $this->takenAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhoto
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
     * Set creative
     *
     * @param \Skaphandrus\AppBundle\Entity\SkCreativeCommons $creative
     *
     * @return SkPhoto
     */
    public function setCreative(\Skaphandrus\AppBundle\Entity\SkCreativeCommons $creative = null) {
        $this->creative = $creative;

        return $this;
    }

    /**
     * Get creative
     *
     * @return \Skaphandrus\AppBundle\Entity\SkCreativeCommons
     */
    public function getCreative() {
        return $this->creative;
    }

    /**
     * Set model
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel $model
     *
     * @return SkPhoto
     */
    public function setModel(\Skaphandrus\AppBundle\Entity\SkPhotoMachineModel $model = null) {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoMachineModel
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Set spot
     *
     * @param \Skaphandrus\AppBundle\Entity\SkSpot $spot
     *
     * @return SkPhoto
     */
    public function setSpot(\Skaphandrus\AppBundle\Entity\SkSpot $spot = null) {
        $this->spot = $spot;

        return $this;
    }

    /**
     * Get spot
     *
     * @return \Skaphandrus\AppBundle\Entity\SkSpot
     */
    public function getSpot() {
        return $this->spot;
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

    /**
     * Set isValidated
     *
     * @param boolean $isValidated
     *
     * @return SkPhotoContest
     */
    public function setIsValidated($isValidated) {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * Get isValidated
     *
     * @return boolean
     */
    public function getIsValidated() {
        return $this->isValidated;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhoto
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Skaphandrus\AppBundle\Entity\FosUser
     */
    public function getFosUser() {
        return $this->fosUser;
    }

    /**
     * Add keyword
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKeyword $keyword
     *
     * @return SkPhoto
     */
    public function addKeyword(\Skaphandrus\AppBundle\Entity\SkKeyword $keyword) {
        $this->keyword[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \Skaphandrus\AppBundle\Entity\SkKeyword $keyword
     */
    public function removeKeyword(\Skaphandrus\AppBundle\Entity\SkKeyword $keyword) {
        $this->keyword->removeElement($keyword);
    }

    /**
     * Get keyword
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeyword() {
        return $this->keyword;
    }

    /**
     * Add category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhoto
     */
    public function addCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     */
    public function removeCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory() {
        return $this->category;
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
        return 'uploads/fotografias';
    }

//    private $file;
//
//    /**
//     * Sets file.
//     *
//     * @param UploadedFile $file
//     */
//    public function setFile(UploadedFile $file = null) {
//        $this->file = $file;
//    }
//
//    /**
//     * Get file.
//     *
//     * @return UploadedFile
//     */
//    public function getFile() {
//        return $this->file;
//    }
//    /**
//     * 
//     * @return type
//     */
//    public function upload() {
//        // the file property can be empty if the field is not required
//        if (null === $this->getFile()) {
//            return;
//        }
//
//        $filename = sha1(uniqid(mt_rand(), true));
//
//        $this->image = $filename . '.' . $this->getFile()->guessExtension();
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
//        // clean up the file property as you won't need it anymore
//        $this->file = null;
//    }

    public function getKeywordsString() {
        $string = '';

        foreach ($this->keyword->toArray() as $keyword) {
            $string .= $keyword->getKeyword() . ', ';
        }

        return substr($string, 0, -2);
    }

    public function countComments() {

        return "123";
    }

    public function countLikes() {

        return "321";
    }

    /**
     * Add speciesValidation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $speciesValidation
     *
     * @return SkPhoto
     */
    public function addSpeciesValidation(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $speciesValidation) {
        $this->speciesValidations[] = $speciesValidation;

        return $this;
    }

    /**
     * Remove speciesValidation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $speciesValidation
     */
    public function removeSpeciesValidation(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation $speciesValidation) {
        $this->speciesValidations->removeElement($speciesValidation);
    }

    /**
     * Get speciesValidations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeciesValidations() {
        return $this->speciesValidations;
    }

    /**
     * Add speciesSugestion
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion $speciesSugestion
     *
     * @return SkPhoto
     */
    public function addSpeciesSugestion(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion $speciesSugestion) {
        $this->speciesSugestions[] = $speciesSugestion;

        return $this;
    }

    /**
     * Remove speciesSugestion
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion $speciesSugestion
     */
    public function removeSpeciesSugestion(\Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion $speciesSugestion) {
        $this->speciesSugestions->removeElement($speciesSugestion);
    }

    /**
     * Get speciesSugestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeciesSugestions() {
        return $this->speciesSugestions;
    }

    public function doStuffOnPreUpdate() {
        $this->updatedAt = new \DateTime();
    }

//    public static function loadValidatorMetadata(ClassMetadata $metadata) {
//        $metadata->addPropertyConstraint('imageFile', new Assert\File(array(
//            'maxSize' => '8000k',
//            'mimeTypes' => array(
//                'image/jpg',
//                'image/jpeg',
//            ),
//            'mimeTypesMessage' => 'Please upload a valid PDF',
//            'maxSizeMessage' => 'Please upload a valid PDF',
//        )));
//    }

    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity->getSpecies()) {

            //enviar notificação para quem já validou espécie
            //(x associou especie y a fotografia z)	message_ada
            $query = $entityManager->createQuery(
                            'SELECT v
                                FROM SkaphandrusAppBundle:SkPhotoSpeciesValidation v
                                WHERE v.species = :species_id
                                GROUP BY v.fosUser'
                    )->setParameter('species_id', $entity->getSpecies()->getId());
            $validations = $query->getResult();

            foreach ($validations as $validation) {
//                $entityManager->getRepository('SkaphandrusAppBundle:SkSocialNotify')->findBySendSocialNotifyFromPhoto(
//                        $entity, $photoSpeciesValidation->getFosUser(), "message_ada");

                if ($entity->getFosUser()->getId() <> $validation->getFosUser()->getId()) {

                    //$entityManager = $this->getEntityManager();
                    $skSocialNotify = new SkSocialNotify();
                    $skSocialNotify->setUserFrom($entity->getFosUser());
                    $skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                    $skSocialNotify->setPhoto($entity);
                    $skSocialNotify->setMessageName("message_ada");
                    $skSocialNotify->setCreatedAt(new \DateTime());
                    $skSocialNotify->setUserTo($validation->getFosUser());
                    $entityManager->persist($skSocialNotify);
                    $entityManager->flush();
                }
            }
        }
    }

//    public function doStuffOnPostLoad(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
//        $entity = $args->getEntity();
//        //$entity = new SkPhoto();
//
//        $entityManager = $args->getEntityManager();
//
//        if (!$entity->getSpecies()) {
//            if ($entity->getSpeciesValidations()) {
//                //$entity->setSpecies($entity->getSpeciesValidations()[0]->getSpecies());
//            } elseif ($entity->getSpeciesSugestions()) {
//                //$entity->setSpecies($entity->getSpeciesValidations()[0]->getSpecies());
//            }
//        }
//
//        $entityManager->persist($entity);
//        $entityManager->flush();
//    }
}
