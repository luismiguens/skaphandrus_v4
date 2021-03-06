<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkLocationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkLocationRepository extends EntityRepository {

    public function getMoreLocationCountry($country_id, $limit = 3, $offset = 0) {

//        $query = $this->getEntityManager()
//                ->createQuery(
//                        'SELECT l as location, count(p.id) as photosInLocation
//                        FROM SkaphandrusAppBundle:SkLocation l
//                        JOIN l.region r
//                        JOIN r.country c
//                        JOIN SkaphandrusAppBundle:SkSpot s WITH s.location = l.id
//                        LEFT JOIN SkaphandrusAppBundle:SkPhoto p WITH p.spot = s.id
//                        WHERE r.country = :country_id
//                        GROUP BY l.id
//                        ORDER BY photosInLocation desc')
//                ->setParameter('country_id', $country_id)
//                ->setMaxResults($limit)
//                ->setFirstResult($offset)
//                ->getResult();
//
//        try {
//            return $query;
//        } catch (\Doctrine\ORM\NoResultException $e) {
//            return null;
//        }

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('l as location')
                ->addSelect('Count(p.id) as photosInLocation');
        $qb->from('SkaphandrusAppBundle:SkLocation', 'l');
        $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
        $qb->join('r.country', 'c', 'WITH', 'r.country = :coutry_id');
        $qb->join('SkaphandrusAppBundle:SkSpot', 's', 'WITH', 's.location = l.id');
        $qb->leftJoin('SkaphandrusAppBundle:SkPhoto', 'p', 'WITH', 'p.spot = s.id');
        $qb->groupBy('location');
        $qb->orderBy('photosInLocation', 'desc');

        $qb->setParameter('coutry_id', $country_id);
        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);

        $result = array();

        foreach ($qb->getQuery()->getResult() as $value) {
            $value['location']->setPhotosInLocation($value['photosInLocation']);
            $result[] = $value['location'];
        }

        try {
            return $result;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findPhotosCountry($location_id, $country_id) {
        $query = $this->getEntityManager()->createQuery(
                        'SELECT p
            FROM SkaphandrusAppBundle:SkPhoto p
            JOIN p.spot s
            JOIN s.location l
            JOIN l.region r
            WHERE l.id = :location_id and r.country = :country_id
            ORDER BY p.id desc'
                )->setParameter('location_id', $location_id)->setParameter('country_id', $country_id)->setMaxResults(10);

        return $query->getResult();
    }

//    public function findOneWithTranslations($id)
//    {
//        $qb = $this->createQueryBuilder('l')
//            ->select('l, t')
//            ->join('l.translations', 't')
//            ->where('l.id = :id')
//            ->setParameter('id', $id);
//
//        //dump($qb->getQuery()->getSingleResult());
//        
//        return $qb->getQuery()->getSingleResult();
//    }

    public function findLocationDestinations($slug, $locale) {
        $name = Utils::unslugify($slug);

        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT l
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN l.translations t
                    WHERE REPLACE(t.name, \'-\', \' \') = :name
                    AND t.locale = :locale'
                    )->setParameter('name', $name)->setParameter('locale', $locale);
        try {
//            dump($query->getResult());
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findBySlug_old($slug, $country, $locale) {
        $name = Utils::unslugify($slug);

        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT l
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN l.translations t
                    JOIN l.region r
                    WHERE REPLACE(t.name, \'-\', \' \') = :name
                    AND t.locale = :locale
                    AND IDENTITY(r.country) = ' . $this->getEntityManager()->getRepository('SkaphandrusAppBundle:SkCountry')->findBySlug($country, $locale)->getId()
                        )->setParameter('name', $name)->setParameter('locale', $locale);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findBySlug($slug, $country, $locale) {
        $name = Utils::unslugify($slug);

        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT l
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN l.translations t
                    JOIN l.region r
                    WHERE REPLACE(t.name, \'-\', \' \') = :name
                    AND t.locale = :locale 
                    AND IDENTITY(r.country) = ' . $this->getEntityManager()->getRepository('SkaphandrusAppBundle:SkCountry')->findBySlug($country, $locale)->getId()
                        )->setParameter('name', $name)->setParameter('locale', $locale);
        try {
//            dump($query->getResult());
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findLikeName($term, $locale) {

        return $this->getEntityManager()->createQuery(
                        "SELECT l
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN l.translations t
                    WHERE t.name LIKE :term
                    AND t.locale = :locale
                    ORDER BY t.name DESC"
                )->setParameter('term', '%' . $term . '%')->setParameter('locale', $locale)->getResult();
    }

    public function findAllLocationsWithSpots() {

        return $this->getEntityManager()->createQuery(
                        "SELECT l
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN SkaphandrusAppBundle:SkSpot s WITH s.location = l.id"
                )->getResult();
    }

    public function findLocationsInCountry($country_id) {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('l as location')
                ->addSelect('Count(p.id) as photosInLocation');
        $qb->from('SkaphandrusAppBundle:SkLocation', 'l');
        $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
        $qb->join('r.country', 'c', 'WITH', 'r.country = :coutry_id');
        $qb->join('SkaphandrusAppBundle:SkSpot', 's', 'WITH', 's.location = l.id');
        $qb->leftJoin('SkaphandrusAppBundle:SkPhoto', 'p', 'WITH', 'p.spot = s.id');
        $qb->groupBy('location');
        $qb->orderBy('photosInLocation', 'desc');

        $qb->setParameter('coutry_id', $country_id);

        $result = array();

        foreach ($qb->getQuery()->getResult() as $value) {
            $value['location']->setPhotosInLocation($value['photosInLocation']);
            $result[] = $value['location'];
        }

        try {
            return $result;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

//    public function findAllForList($country_id) {
//        return $this->getEntityManager()
//                        ->createQuery(
//                                'SELECT l
//                FROM SkaphandrusAppBundle:SkLocation l
//                JOIN l.region r
//                JOIN r.country c
//                JOIN SkaphandrusAppBundle:SkSpot s
//                    WITH IDENTITY(s.location) = l.id
//                WHERE IDENTITY(r.country) = :country_id
//                GROUP BY l.id')->setParameter('country_id', $country_id)->getResult();
//    }

    public function countSpotsArray() {
        $spots = $this->getEntityManager()
                        ->createQuery(
                                'SELECT l.id location_id, count(s.id) as spot_count
                    FROM SkaphandrusAppBundle:SkSpot s
                    JOIN s.location l
                    GROUP BY l.id'
                        )->getResult();

        $spots_array = array();
        foreach ($spots as $result) {
            $spots_array[$result['location_id']] = $result['spot_count'];
        }
        return $spots_array;
    }

    public function countPhotosArray() {
        $photos = $this->getEntityManager()
                        ->createQuery(
                                'SELECT l.id location_id, count(p.id) as photo_count
                    FROM SkaphandrusAppBundle:SkPhoto p
                    JOIN p.spot s
                    JOIN s.location l
                    group by l.id'
                        )->getResult();

        $photos_array = array();
        foreach ($photos as $result) {
            $photos_array[$result['location_id']] = $result['photo_count'];
        }
        return $photos_array;
    }

//    public function getPhotographers($location_id) {
//        return $this->getEntityManager()
//                        ->createQuery(
//                                'SELECT u as fosUser, count(p.id) as photoCount
//                FROM SkaphandrusAppBundle:FosUser u
//                JOIN SkaphandrusAppBundle:SkPhoto p
//                    WITH IDENTITY(p.fosUser) = u.id
//                JOIN p.spot s
//                JOIN s.location l
//                WHERE l.id = :location_id
//                GROUP BY u.id'
//                        )->setParameter('location_id', $location_id)->getResult();
//    }

    public function findSearchResults($string, $locale) {
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT l as location, lt.name as title, lt.description as description, c.name as country_name
                    FROM SkaphandrusAppBundle:SkLocation l
                    JOIN l.translations lt
                    JOIN l.region r
                    JOIN r.country c
                    WHERE lt.locale = :locale
                    AND lt.name LIKE :string'
                        )->setParameter('locale', $locale)->setParameter('string', '%' . $string . '%')->getResult();
    }

    public function getSpots($location_id) {
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT s 
                    FROM SkaphandrusAppBundle:SkSpot s
                    JOIN s.location l
                    WHERE l.id = :location_id'
                        )->setParameter('location_id', $location_id)->getResult();
    }

    public function findLocationsInCountry_to_delete($country_id, $locale) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT l.id as location, lt.id as lt_id, lt.name as lt_name, count(p.id) as num_photos
                FROM sk_photo as p
                RIGHT JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_location as l
                ON l.id = s.location_id
                JOIN sk_location_translation as lt
                ON l.id = lt.translatable_id
                JOIN sk_region as r
                ON l.region_id = r.id
                JOIN sk_country as c
                ON r.country_id = c.id
                where c.id = " . $country_id . " and lt.locale = '" . $locale . "'
                group by location
                order by num_photos desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $location = $em->getRepository('SkaphandrusAppBundle:SkLocation')->find($value['location']);

//            $location = new \Skaphandrus\AppBundle\Entity\SkLocation();
//            $location->setId($value['location']);
//            $location->translate($locale)->setName($value['lt_name']);
//            
            $location->setPhotosInLocation($value['num_photos']);
            $result[] = $location;
        }

        return $result;
    }

}
