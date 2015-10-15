<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkSpotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkSpotRepository extends EntityRepository {

    public function findLikeName($term, $locale) {

        return $this->getEntityManager()->createQuery(
                        "SELECT s, l
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN s.translations t
                JOIN s.location l
         WHERE t.name LIKE :term
         AND t.locale = :locale
        ORDER BY t.name DESC"
                )->setParameter('term', '%' . $term . '%')->setParameter('locale', $locale)->getResult();
    }

    public function findBySlug($slug, $location, $country, $locale) {
        $name = Utils::unslugify($slug);

        $location = $this->getEntityManager()->getRepository('SkaphandrusAppBundle:SkLocation')->findBySlug($location, $country, $locale);
        //dump($location);
        $location_id = $location->getId();

        $query = $this->getEntityManager()
                ->createQuery(
                        'SELECT s
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN s.translations t
                JOIN s.location l
                WHERE t.name = :name
                AND t.locale = :locale
                AND IDENTITY(s.location) = :location_id')
                ->setParameter('name', $name)
                ->setParameter('locale', $locale)
                ->setParameter('location_id', $location->getId());
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findByUserId($user_id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT s
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN SkaphandrusAppBundle:SkPhoto p
                    WITH s.id = IDENTITY(p.spot)
                WHERE IDENTITY(p.fosUser) = :user_id'
                        )->setParameter('user_id', $user_id);
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

//    public function findWithPhotoCountByUserId($user_id) {
//        $query = $this->getEntityManager()
//            ->createQuery(
//                'SELECT s as spot, COUNT(p) as photo_count
//                FROM SkaphandrusAppBundle:SkSpot s
//                JOIN SkaphandrusAppBundle:SkPhoto p
//                    WITH s.id = IDENTITY(p.spot)
//                WHERE IDENTITY(p.fosUser) = :user_id
//                GROUP BY s.id'
//                )->setParameter('user_id', $user_id);
//        try {
//            return $query->getResult();
//        } catch (\Doctrine\ORM\NoResultException $e) {
//            return null;
//        }
//    }

    public function findPhotos($spot_id) {
        $query = $entityManager->createQuery(
                        'SELECT p
            FROM SkaphandrusAppBundle:SkPhoto p
            WHERE spot_id > :spot_id'
                )->setParameter('spot_id', $spot_id);

        return $query->getResult();
    }

//    public function getPhotographers($spot_id) {
//        return $this->getEntityManager()
//            ->createQuery(
//                'SELECT u as fosUser, count(p.id) as photoCount
//                FROM SkaphandrusAppBundle:FosUser u
//                JOIN SkaphandrusAppBundle:SkPhoto p
//                    WITH IDENTITY(p.fosUser) = u.id
//                JOIN p.spot s
//                WHERE s.id = :spot_id
//                GROUP BY u.id'
//            )->setParameter('spot_id', $spot_id)->getResult();
//    }

    public function findSearchResults($string, $locale) {
        return $this->getEntityManager()
                        ->createQuery(
                                'SELECT
                    s as spot,
                    st.name as title,
                    st.description as description,
                    lt.name as location_name,
                    c.name as country_name
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN s.translations st
                JOIN s.location l
                JOIN l.translations lt
                JOIN l.region r
                JOIN r.country c
                WHERE st.locale = :locale
                AND lt.locale = :locale
                AND st.name LIKE :string'
                        )->setParameter('locale', $locale)->setParameter('string', '%' . $string . '%')->getResult();
    }

    public function findSpotsInLocation($location_id, $locale) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT s.id as spot, st.id as st_id, st.name as st_name, count(p.id) as num_photos
                FROM sk_photo as p
                JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_spot_translation as st
                on s.id = st.translatable_id
                JOIN sk_location as l
                ON l.id = s.location_id
                where l.id = " . $location_id . " and st.locale = '" . $locale . "'
                group by spot";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $spot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($value['spot']);

            $spot = new \Skaphandrus\AppBundle\Entity\SkSpot();
            $spot->setId($value['spot']);
            $spot->translate($locale)->setName($value['st_name']);

            $spot->setPhotosInSpot($value['num_photos']);
            $result[] = $spot;
        }

        return $result;
    }

    public function findSpotsInUser($user_id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT s as spot, COUNT(p.id) as photosInSpot
                FROM SkaphandrusAppBundle:SkSpot s
                JOIN SkaphandrusAppBundle:SkPhoto p WITH s.id = p.spot
                WHERE p.fosUser = :user_id
                GROUP BY spot'
                        )->setParameter('user_id', $user_id);

//            dump($query->getResult());

        foreach ($query->getResult() as $value) {
//            $spot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($value['spot']);

            $value['spot']->setPhotosInSpot($value['photosInSpot']);

            $result[] = $value['spot'];
        }

//        return $result;

        try {
            return $result;
//            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findSpotsInUser2($user_id, $locale) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT s.id as spot, st.id as st_id, st.name as st_name, count(p.id) as num_photos
                FROM sk_photo as p
                JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_spot_translation as st
                on s.id = st.translatable_id
                where p.fos_user_id = " . $user_id . " and st.locale = '" . $locale . "'
                group by spot";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $spot = $em->getRepository('SkaphandrusAppBundle:SkSpot')->find($value['spot']);

            $spot = new \Skaphandrus\AppBundle\Entity\SkSpot();
            $spot->setId($value['spot']);
            $spot->translate($locale)->setName($value['st_name']);

            $spot->setPhotosInSpot($value['num_photos']);
            $result[] = $spot;
        }

        dump($result);

        return $result;
    }

}
