<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkSpotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkIdentificationModuleRepository extends EntityRepository {

   

    public function findBySlug($slug,$locale) {
        $name = str_replace('-', ' ', $slug);

        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT m
                FROM SkaphandrusAppBundle:SkIdentificationModule m
                JOIN m.translations t
                WHERE t.name = :name
                AND t.locale = :locale' )->setParameter('name', $name)->setParameter('locale', $locale);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}
