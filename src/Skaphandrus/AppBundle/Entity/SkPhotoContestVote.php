<?php

namespace Skaphandrus\AppBundle\Entity;

/**
 * SkPhotoContestVote
 */
class SkPhotoContestVote {

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    private $photo;

    /**
     * @var \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    private $category;

    /**
     * @var \Skaphandrus\AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SkPhotoContestVote
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
     * Set photo
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhoto $photo
     *
     * @return SkPhotoContestVote
     */
    public function setPhoto(\Skaphandrus\AppBundle\Entity\SkPhoto $photo) {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhoto
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * Set category
     *
     * @param \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category
     *
     * @return SkPhotoContestVote
     */
    public function setCategory(\Skaphandrus\AppBundle\Entity\SkPhotoContestCategory $category) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set fosUser
     *
     * @param \Skaphandrus\AppBundle\Entity\FosUser $fosUser
     *
     * @return SkPhotoContestVote
     */
    public function setFosUser(\Skaphandrus\AppBundle\Entity\FosUser $fosUser) {
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

    public function doStuffOnPostPersist(\Doctrine\ORM\Event\LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        //enviar notificação para dono da fotografia	validation
        //(x votou na tua fotografia y) message_bba

        //$entity = new SkPhotoContestVote();

        if ($entity->getFosUser()->getId() <> $entity->getPhoto()->getFosUser()->getId()) {


            $query = $entityManager->createQuery(
                            'SELECT v
                                FROM SkaphandrusAppBundle:SkSocialNotify v
                                WHERE v.photo = :photo_id
                               AND v.categoryId = :category_id
                               AND v.userFrom = :fos_user_id'
                    )->setParameter('photo_id', $entity->getPhoto()->getId())
                    ->setParameter('category_id', $entity->getCategory()->getId())
                    ->setParameter('fos_user_id', $entity->getFosUser()->getId());
            $vote = $query->getResult();

            if (!$vote) {

                //$entityManager = $this->getEntityManager();
                $skSocialNotify = new SkSocialNotify();
                $skSocialNotify->setUserFrom($entity->getFosUser());
                //$skSocialNotify->setSpeciesId($entity->getSpecies()->getId());
                $skSocialNotify->setPhoto($entity->getPhoto());
                $skSocialNotify->setCategoryId($entity->getCategory()->getId());
                $skSocialNotify->setMessageName("message_bba");
                $skSocialNotify->setCreatedAt(new \DateTime());
                $skSocialNotify->setUserTo($entity->getPhoto()->getFosUser());
                $entityManager->persist($skSocialNotify);
                $entityManager->flush();
            }
        }
    }

}
