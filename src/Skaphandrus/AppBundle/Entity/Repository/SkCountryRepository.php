<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Intl\Intl;
use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkCountryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkCountryRepository extends EntityRepository {

    public function findBySlug($slug) {
        $countries = Intl::getRegionBundle()->getCountryNames();
        $country = FALSE;
        $name = Utils::unslugify($slug);

        $exceptions = array(
            'AN' => 'Netherlands Antilles',
        );

        $countries = array_merge($countries, $exceptions);

        if ($key = array_search($name, $countries)) {
            return $this->findOneByName($key);
        }

        return NULL;
    }

    public function findAllWithSpots() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT c
                FROM SkaphandrusAppBundle:SkCountry c
                JOIN SkaphandrusAppBundle:SkRegion r
                    WITH IDENTITY(r.country) = c.id
                JOIN SkaphandrusAppBundle:SkLocation l
                    WITH IDENTITY(l.region) = r.id
                JOIN SkaphandrusAppBundle:SkSpot s
                    WITH IDENTITY(s.location) = l.id
                LEFT JOIN SkaphandrusAppBundle:SkPhoto p
                    WITH IDENTITY(p.spot) = s.id
                ')->getResult();
    }

    public function countSpotsArray() {
        $spots = $this->getEntityManager()
            ->createQuery(
                'SELECT c.name code, count(s.id) as spot_count
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN s.location l
                JOIN l.region r
                JOIN r.country c
                GROUP BY c.name'
                )->getResult();

        $spots_array = array();
        foreach ($spots as $result) {
            $spots_array[$result['code']] = $result['spot_count'];
        }
        return $spots_array;
    }

    public function countPhotosArray() {
        $photos = $this->getEntityManager()
            ->createQuery(
                'SELECT c.name code, count(p.id) as photo_count
                FROM SkaphandrusAppBundle:SkPhoto p
                JOIN p.spot s
                JOIN s.location l
                JOIN l.region r
                JOIN r.country c
                GROUP BY c.name'
                )->getResult();

        $photos_array = array();
        foreach ($photos as $result) {
            $photos_array[$result['code']] = $result['photo_count'];
        }
        return $photos_array;
    }
}
