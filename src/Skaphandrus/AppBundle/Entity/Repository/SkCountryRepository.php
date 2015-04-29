<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkCountryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkCountryRepository extends EntityRepository {
    public function findSpotsCountByLocationForCountry($country_id) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT l as location, COUNT(s.id) as spots_number
                FROM SkaphandrusAppBundle:SkLocation l
                JOIN l.region r
                JOIN SkaphandrusAppBundle:SkSpot s
                    WITH IDENTITY(s.location) = l.id
                WHERE IDENTITY(r.country) = :country_id
                GROUP BY l.id
                ORDER BY spots_number DESC"
            )->setParameter('country_id', $country_id)->getResult();
    }
}
