<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkClassRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkClassRepository extends EntityRepository {

    public function findLikeName($term) {
        return $this->getEntityManager()->createQuery(
                        "SELECT c
          FROM SkaphandrusAppBundle:SkClass c
          WHERE c.name LIKE :term
          ORDER BY c.name DESC"
                )->setParameter('term', '%' . $term . '%')->getResult();
    }

    public function getSpecies($class_id) {
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT s 
                FROM SkaphandrusAppBundle:SkSpecies s
                JOIN s.genus g
                JOIN g.family f
                JOIN f.order o
                JOIN o.class c
                WHERE c.id = :class_id'
                        )->setParameter('class_id', $class_id)->getResult();
    }

}