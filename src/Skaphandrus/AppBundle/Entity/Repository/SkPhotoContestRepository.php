<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkPhotoContestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkPhotoContestRepository extends EntityRepository {

    public function findPhotographers($contest) {
        $categories = $contest->getCategories();
        $users = array();

        foreach ($categories as $category) {
            foreach ($category->getPhoto() as $photo) {
                $user = $photo->getFosUser();

                if ($user && !array_key_exists($user->getId(), $users)) {
                    $users[$user->getId()] = $user;
                }
            }
        }

        return $users;
    }

    public function findPhotosFromUserInContest($user_id, $contest_id) {
        $categories = $this->getEntityManager()->createQuery(
            'SELECT cat
            FROM SkaphandrusAppBundle:SkPhotoContestCategory cat
            WHERE IDENTITY(cat.contest) = :contest_id'
        )->setParameter('contest_id', $contest_id)->getResult();

        $photos = array();
        foreach ($categories as $category) {
            $photo_ids = array();

            foreach ($category->getPhoto() as $photo) {
                $photo_ids[] = $photo->getId();
            }

            $query = $this->getEntityManager()->createQuery(
                'SELECT p
                FROM SkaphandrusAppBundle:SkPhoto p
                WHERE IDENTITY(p.fosUser) = :user_id
                AND p.id IN (:photo_ids)'
            )->setParameter('user_id', $user_id)
            ->setParameter('photo_ids', implode(',', $photo_ids));

            $photos[$category->getId()] = $query->getResult();
        }

        return $photos;
    }
}
