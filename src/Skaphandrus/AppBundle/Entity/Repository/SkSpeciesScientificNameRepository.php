<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkSpeciesScientificNameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkSpeciesScientificNameRepository extends EntityRepository {

    
    
    public function findLikeName($term) {


        return $this->getEntityManager()->createQuery(
                        "SELECT s 
        FROM SkaphandrusAppBundle:SkSpeciesScientificName s
        WHERE s.name LIKE :term
        ORDER BY s.name DESC"
                )->setParameter('term', '%' . $term . '%')->getResult();
    }
    
    
    
}
