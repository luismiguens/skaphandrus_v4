<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkGenusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkPersonalRepository extends EntityRepository {

    public function findLikeName($term) {

        return $this->getEntityManager()->createQuery(
                        "SELECT p, f
        FROM SkaphandrusAppBundle:SkPersonal p
        join p.fosUser f
        WHERE CONCAT(concat(CONCAT(Concat(p.firstname, ' '), p.middlename),' '),p.lastname) LIKE :term 
        or CONCAT(Concat(p.firstname, ' '),p.lastname) LIKE :term 
        or CONCAT(p.firstname, ' ') LIKE :term order by f.id asc"
                )->setParameter('term', '%' . $term . '%')->getResult();
    }

}
