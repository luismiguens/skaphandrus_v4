<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkSpeciesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkSpeciesRepository extends EntityRepository {

//    public function findBySlug($slug) {
//        $name = str_replace('-', ' ', $slug);
//
//        $query = $this->getEntityManager()
//            ->createQuery(
//                'SELECT s, sn
//                FROM SkaphandrusAppBundle:SkSpecies s
//                JOIN s.scientific_names sn
//                WHERE sn.name = :name'
//                )->setParameter('name', $name);
//        try {
//            return $query->getSingleResult();
//        } catch (\Doctrine\ORM\NoResultException $e) {
//            return null;
//        }
//    }
    
        public function findBySlug($slug) {
        $name = str_replace('-', ' ', $slug);

        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SkaphandrusAppBundle:SkSpecies s
                JOIN s.scientific_names sn
                WHERE sn.name = :name'
                )->setParameter('name', $name);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    

    
    
    
}
