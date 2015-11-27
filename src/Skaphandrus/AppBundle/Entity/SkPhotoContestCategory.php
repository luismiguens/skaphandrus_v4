<?php

namespace Skaphandrus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkPhotoContestCategory
 */
class SkPhotoContestCategory {

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
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    private $contest;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $awards;
    
    
        /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $votations;


    /**
     * var used to save winner photos in category
     * @var type 
     */
    private $winnerPhotos;

    /**
     * Constructor
     */
    public function __construct() {
        $this->photo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setWinnerPhotos($winnerPhotos) {
        $this->winnerPhotos = $winnerPhotos;

        return $this;
    }

    /**
     * Get winnerPhotos
     *
     * @return string
     */
    public function getWinnerPhotos() {
        return $this->winnerPhotos;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SkPhotoContestCategory
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set contest
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContest $contest
     *
     * @return SkPhotoContestCategory
     */
    public function setContest(\Skaphandrus\AppBundle\Entity\SkPhotoContest $contest = null) {
        $this->contest = $contest;

        return $this;
    }

    /**
     * Get contest
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContest
     */
    public function getContest() {
        return $this->contest;
    }

    /**
     * Add photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoContestCategory
     */
    public function addPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photo[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     */
    public function removePhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photo->removeElement($photo);
    }

    /**
     * Get photo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhoto() {
        return $this->photo;
    }

    
    
    /**
     * Add votation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation $votation
     *
     * @return SkPhotoContestCategory
     */
    public function addVotation(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation $votation) {
        $this->votations[] = $votation;

        return $this;
    }

    /**
     * Remove votation
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestVotation $votation
     */
    public function removeVotation(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategoryJudgeVotation $votation) {
        $this->votations->removeElement($votation);
    }

    /**
     * Get votations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotations() {
        return $this->votations;
    }

    
    
    
    
    
    
    
    
    
    
    /**
     * Add award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     *
     * @return SkPhotoContestCategory
     */
    public function addAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * Remove award
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award
     */
    public function removeAward(\Skaphandrus\AppBundle\Entity\SkPhotoContestAward $award) {
        $this->awards->removeElement($award);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwards() {
        return $this->awards;
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

    public function __toString() {
        return $this->getName();
    }

    public function getCategoryJoinContestString() {
        return $this->getName() . " » " . $this->getContest();
    }

    public function getName() {
        return $this->translate()->getName();
    }

//    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
//
//        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//
//        //enviar notificação para quem tem fotografias na categoria
//        //(x tambem adicionou fotografia y a categoria z)	message_baa
//        $query = $entityManager->createQuery(
//                        'SELECT p
//                        FROM SkaphandrusAppBundle:SkPhoto as p
//                        JOIN SkaphandrusAppBundle:SkPhotoContestCategory as c on c.photo = p
//                        JOIN SkaphandrusAppBundle:FosUser as u on u = p.fos_user
//                        WHERE c.category = :category_id'
//                )->setParameter('category_id', $entity->getPhotoContestCategory()->getId());
//        $photos = $query->getResult();
//
//        dump($photos);
//
//        foreach ($photos as $photo) {
//
//            if ($entity->getFosUser()->getId() <> $photo->getFosUser()->getId()) {
//
//                $skSocialNotify = new SkSocialNotify();
//                $skSocialNotify->setUserFrom($entity->getFosUser());
//                $skSocialNotify->setCategoryId($entity->getPhotoContestCategory()->getId());
//                $skSocialNotify->setPhoto($entity);
//                $skSocialNotify->setMessageName("message_baa");
//                $skSocialNotify->setCreatedAt(new \DateTime());
//                $skSocialNotify->setUserTo($photo->getFosUser());
//                $entityManager->persist($skSocialNotify);
//                $entityManager->flush();
//            }
//        }
//    }

}
