<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Intl\Intl;
use Skaphandrus\AppBundle\Utils\Utils;

/**
 * SkCurrencyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkBusinessRepository extends EntityRepository {

    
    public function findBusinessessByType($types) {

//1,"Dive Center"
//2,"Dive School"
//3,"Dive Shop"
//4,Liveaboard
//5,"Dive Association"
//6,"Dive Club"
//7,Accommodation
//8,"Travel Agency"
//9,"Dive Brand"
//10,"Dive Organization"
//11,"Dive Magazine"
//12,"Hyperbaric Chamber"
        
        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in('.  implode(', ', $types).')')
                        ->getResult();
    }
    
    
    
    
    // See All
    public function findAllDiveCenters() {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(1,3,6,8)')
                        ->getResult();
    }

    public function findAllLiveaboards() {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(4)')
                        ->getResult();
    }

    public function findAllAccommodations() {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(7)')
                        ->getResult();
    }

    // Partial
    public function findDiveCentersPartial($limit = 6, $offset = 0) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(1)
                GROUP BY b
                ORDER BY b.updatedAt DESC')
                        ->setMaxResults($limit)->setFirstResult($offset)->getResult();
    }

    public function findLiveaboardsPartial($limit = 6, $offset = 0) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(4)
                GROUP BY b
                ORDER BY b.updatedAt DESC')
                        ->setMaxResults($limit)->setFirstResult($offset)->getResult();
    }

    public function findAccommodationsPartial($limit = 6, $offset = 0) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin a
                JOIN b.type t
                WHERE t.id in(7)
                GROUP BY b
                ORDER BY b.updatedAt DESC')
                        ->setMaxResults($limit)->setFirstResult($offset)->getResult();
    }

////////////////////
    public function findDiveCentersInSpot($spot_id) {
//                WHERE t.id in(1,3,6,8)

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.spots s
                WHERE t.id in(1)  
                AND s.id = :spot_id')
                        ->setParameter('spot_id', $spot_id)->getResult();
    }

    public function findLiveaboardsInSpot($spot_id) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.spots s
                WHERE t.id in(4) 
                AND s.id = :spot_id')
                        ->setParameter('spot_id', $spot_id)->getResult();
    }

    public function findAccommodationsInSpot($spot_id) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.spots s
                WHERE t.id in(7) 
                AND s.id = :spot_id')
                        ->setParameter('spot_id', $spot_id)->getResult();
    }

////////////////////
//
////////////////////
    public function findDiveCentersInLocation($location_id) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                WHERE t.id in(1) 
                AND a.location = :location_id')
                        ->setParameter('location_id', $location_id)->getResult();
    }

    public function findLiveaboardsInLocation($location_id) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                WHERE t.id in(4) 
                AND a.location = :location_id')
                        ->setParameter('location_id', $location_id)->getResult();
    }

    public function findAccommodationsInLocation($location_id) {

        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                WHERE t.id in(7) 
                AND a.location = :location_id')
                        ->setParameter('location_id', $location_id)->getResult();
    }

////////////////////
//
////////////////////
    public function findDiveCentersInCountry($country_id) {
        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.region r
                WHERE t.id in(1) 
                AND r.country = :country_id')
                        ->setParameter('country_id', $country_id)->getResult();
    }

    public function findLiveaboardsInCountry($country_id) {
        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.region r
                WHERE t.id in(4) 
                AND r.country = :country_id')
                        ->setParameter('country_id', $country_id)->getResult();
    }

    public function findAccommodationsInCountry($country_id) {
        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                JOIN b.type t
                JOIN b.address a
                JOIN a.location l
                JOIN l.region r
                WHERE t.id in(7) 
                AND r.country = :country_id')
                        ->setParameter('country_id', $country_id)->getResult();
    }

////////////////////
//
////////////////////
    public function findLikeName($term) {

        return $this->getEntityManager()->createQuery(
                        "SELECT b
        FROM SkaphandrusAppBundle:SkBusiness b
        WHERE b.name LIKE :term "
                )->setParameter('term', '%' . $term . '%')->getResult();
    }

    public function findBySlug($country, $location, $slug, $locale) {
        $name = Utils::unslugify($slug);
        $location = $this->getEntityManager()->getRepository('SkaphandrusAppBundle:SkLocation')
                ->findBySlug($location, $country, $locale);

        $query = $this->getEntityManager()
                ->createQuery(
                        'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.address a
                JOIN a.location l
                JOIN l.region r
                WHERE REPLACE(REPLACE(b.name, \'_\', \'/\'), \'-\', \' \') = :name
                AND IDENTITY(a.location) = :location_id')
                ->setParameter('name', $name)
                ->setParameter('location_id', $location->getId());
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findAllJoinLanguagesAndCurrencies_Old() {
        return $this->getEntityManager()->createQuery(
                        'SELECT b, l, c
            FROM SkaphandrusAppBundle:SkBusiness b
            Left JOIN b.language l
            Left join b.currency c'
                )->getResult();
    }

    public function findAllWithAddress() {
        return $this->getEntityManager()->createQuery(
                        'SELECT b, a, l, r, c
            FROM SkaphandrusAppBundle:SkBusiness b
            JOIN b.address a
            JOIN a.location l
            JOIN l.region r
            JOIN r.country c'
                )->getResult();
    }

    public function findAllBusinessLite() {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT b.id as id, b.name as name
                FROM sk_business as b
                order by name asc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $business = new \Skaphandrus\AppBundle\Entity\SkBusiness();
            $business->setId($value['id']);
            $business->setName($value['name']);

            $result[] = $business;
        }

        return $result;
    }

    public function findAllWithAdmin(){
            
//        SELECT b.name as name, c.name as country_name, concat(p.firstname,' ',p.middlename, ' ', p.lastname) as user
//FROM sk_business as b 
//JOIN sk_address as a on b.id = a.business_id 
//JOIN sk_business_user as bu on bu.business_id = b.id 
//JOIN fos_user as u on bu.fos_user_id = u.id join sk_personal as p on u.id = p.fos_user_id
//LEFT JOIN sk_location as l on a.location_id = l.id 
//LEFT JOIN sk_region as r on r.id = l.region_id 
//LEFT JOIN sk_country as c on c.id = r.country_id 
//ORDER by c.name desc
        
        
        return $this->getEntityManager()->createQuery(
                                'SELECT b
                FROM SkaphandrusAppBundle:SkBusiness b
                JOIN b.admin admin
                ')->getResult();
        
        
        
    }
            
            
      
    
    
    
    public function findAllBusiness($locale, $user) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT b.id as id, b.name as name, b.premium_at as premium,b.plus_at as plus, lt.name as location_name, c.name as country_name
                FROM sk_business as b
                LEFT JOIN sk_address as a on b.id = a.business_id
                JOIN sk_location as l on a.location_id = l.id
                JOIN sk_location_translation as lt on l.id = lt.translatable_id
                JOIN sk_region as r on r.id = l.region_id
                JOIN sk_country as c on c.id = r.country_id";

        if ($user):
            $sql = $sql . " JOIN sk_business_user as bu on bu.business_id = b.id "
                    . "JOIN fos_user as u on bu.fos_user_id = u.id"
                    . " where u.id = " . $user . " and lt.locale = '" . $locale . "'    "
                    . " order by name asc";
        else:
            $sql = $sql . " where lt.locale = '" . $locale . "'    "
                    . " order by name asc";
        endif;

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        return $values;
    }

    //A ser uzado na pagina business home
    public function findAllBusinessHome($locale) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT b.id as id, b.name as name, b.premium_at as premium, b.picture as picture, lt.name as location_name, c.name as country_name
                FROM sk_business as b
                LEFT JOIN sk_address as a on b.id = a.business_id
                JOIN sk_location as l on a.location_id = l.id
                JOIN sk_location_translation as lt on l.id = lt.translatable_id
                JOIN sk_region as r on r.id = l.region_id
                JOIN sk_country as c on c.id = r.country_id
                where lt.locale = '" . $locale . "'
                group by b.id
                order by name asc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {

            $business = new \Skaphandrus\AppBundle\Entity\SkBusiness();
            $business->setId($value['id']);
            $business->setName($value['name']);
            $business->setPremiumAt($value['premium']);
            $business->setPicture($value['picture']);

            $country = new \Skaphandrus\AppBundle\Entity\SkCountry();
            $country->setName($value['country_name']);

            $region = new \Skaphandrus\AppBundle\Entity\SkRegion();
            $region->setCountry($country);

            $location = new \Skaphandrus\AppBundle\Entity\SkLocation();
            $location->translate($locale)->setName($value['location_name']);
            $location->setRegion($region);

            $address = new \Skaphandrus\AppBundle\Entity\SkAddress();
            $address->setLocation($location);

            $business->setAddress($address);

            $result[] = $business;
        }

        return $result;
    }

}
