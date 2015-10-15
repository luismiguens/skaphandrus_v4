<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * SkPhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkPhotoRepository extends EntityRepository {

    public function findPhotosCountByUserForModel($id, $model = 'species') {
        return $this->getEntityManager()
                        ->createQuery(
                                "SELECT u, COUNT(p.id) as countable
            FROM SkaphandrusAppBundle:FosUser u
            JOIN SkaphandrusAppBundle:SkPhoto p
                WITH u.id = IDENTITY(p.fosUser)
            WHERE IDENTITY(p.$model) = :id
            GROUP BY u.id
            ORDER BY countable DESC"
                        )->setParameter('id', $id)->getResult();
    }

    public function findAllAsPaginator($page, $per_page = 10, $params = array()) {
        $first = ($page - 1) * $per_page;

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
                ->from('SkaphandrusAppBundle:SkPhoto', 'p')
                ->setParameters($params)
                ->setFirstResult($first)
                ->setMaxResults($per_page)
                ->getQuery();

        return new Paginator($qb, TRUE);
    }

    public function getPrimaryPhotoForSpecies($species_id) {
        return $this->findOneBy(array('species' => $species_id), array('id' => 'DESC'));
    }

    
    //utilizado na galeria de fotografias
    public function getQueryBuilder4($params, $limit = 20, $order = array('id' => 'desc'), $offset = 0) {


        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')->from('SkaphandrusAppBundle:SkPhoto', 'p');

        //users
        if (array_key_exists('fosUser', $params)) {
            $qb->andWhere('p.fosUser = ?2');
            $qb->setParameter(2, $params['fosUser']);
        }

        //spots, locations, regions and countries
        if (array_key_exists('spot', $params)) {
            $qb->andWhere('p.spot = ?3');
            $qb->setParameter(3, $params['spot']);
        }

        if (array_key_exists('location', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = ?4');
            $qb->setParameter(4, $params['location']);
        }

        if (array_key_exists('region', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
            $qb->join('l.region', 'r', 'WITH', 'l.region = ?5');
            $qb->setParameter(5, $params['region']);
        }

        if (array_key_exists('country', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
            $qb->join('r.country', 'c', 'WITH', 'r.country = ?6');
            $qb->setParameter(6, $params['country']);
        }


        //species, genus, families, orders, classes, kingdoms
        if (array_key_exists('species', $params)) {
            $qb->andWhere('p.species = ?7');
            $qb->setParameter(7, $params['species']);
        }

        if (array_key_exists('kingdom', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ph.id');
            $qb->join('ph.kingdom', 'k', 'WITH', 'ph.kingdom = ?8');
            $qb->setParameter(8, $params['kingdom']);
        }


        if (array_key_exists('phylum', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ?9');
            $qb->setParameter(9, $params['phylum']);
        }

        if (array_key_exists('class', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = ?10');
            $qb->setParameter(10, $params['class']);
        }

        if (array_key_exists('order', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = ?11');
            $qb->setParameter(11, $params['order']);
        }

        if (array_key_exists('family', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = ?12');
            $qb->setParameter(12, $params['family']);
        }

        if (array_key_exists('genus', $params)) {
            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
            $qb->join('s.genus', 'g', 'WITH', 's.genus = ?13');
//            $qb->join('p.species', 's');
//            $qb->join('s.genus', 'g');
            //$qb->andWhere('g.genus = ?13');
            $qb->setParameter(13, $params['genus']);
        }

        if ($order) {
            $qb->orderBy('p.' . key($order), $order[key($order)]);
        }

        if ($offset) {
            $qb->setFirstResult($offset);
        }


        $qb->setMaxResults($limit);


//        echo $qb;

        return $qb;
    }

    
    
    public function getQueryBuilder3($params, $limit = 20, $order = array('id' => 'desc'), $offset = 0, $locale = "en") {

    $photos = $this->getEntityManager()
                        ->createQuery(
                                "SELECT p
            FROM SkaphandrusAppBundle:FosUser u
            JOIN SkaphandrusAppBundle:SkPhoto p WITH u.id = IDENTITY(p.fosUser)
            JOIN SkaphandrusAppBundle:SkPersonal ps WITH u.id = IDENTITY(ps.fosUser)
                WHERE IDENTITY(p.fosUser) = :id "
                        )->setMaxResults($limit)->setParameter('id', 26)
            ->getResult();
    
    dump($photos);
    
    return $photos;
    
    
    
    }
    
    
    public function getQueryForGrid($params, $limit = 20, $order = array('id' => 'desc'), $offset = 0, $locale = "en") {

        $sql = "SELECT p.id as photo_id, p.title as photo_title, p.image as photo_image, "
                . "p.created_at as photo_created_at, p.taken_at as photo_taken_at, "
                . "f.id as fos_user_id, f.username as fos_user_username, "
                . "fp.id as personal_id, fp.firstname as personal_firstname, fp.middlename as personal_middlename, fp.lastname as personal_lastname, "
                . "s.id as spot_id, st.name as spot_name, "
                . "l.id as location_id, lt.name as location_name "
                . "FROM sk_photo as p "
                . "JOIN fos_user as f on f.id = p.fos_user_id "
                . "JOIN sk_personal as fp on f.id = fp.fos_user_id "
                . "JOIN sk_spot as s on p.spot_id = s.id "
                . "JOIN sk_spot_translation as st on s.id = st.translatable_id "
                . "JOIN sk_location as l on s.location_id = l.id "
                . "JOIN sk_location_translation as lt on l.id = lt.translatable_id ";
        
        //users
        if (array_key_exists('fosUser', $params)) {
            $sql = $sql . ' where p.fos_user_id = ' . $params['fosUser'];
        }

        //spots, locations, regions and countries
        if (array_key_exists('spot', $params)) {
            $sql = $sql . ' where p.spot_id = ' . $params['spot'];
        }

        if (array_key_exists('location', $params)) {
            $sql = $sql . ' where s.location_id = ' . $params['location'];
            
        }


//
//        if (array_key_exists('country', $params)) {
//            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
//            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
//            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
//            $qb->join('r.country', 'c', 'WITH', 'r.country = ?6');
//            $qb->setParameter(6, $params['country']);
//        }
//
//
//        //species, genus, families, orders, classes, kingdoms
//        if (array_key_exists('species', $params)) {
//            $qb->andWhere('p.species = ?7');
//            $qb->setParameter(7, $params['species']);
//        }
//
//        if (array_key_exists('kingdom', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
//            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
//            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
//            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
//            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ph.id');
//            $qb->join('ph.kingdom', 'k', 'WITH', 'ph.kingdom = ?8');
//            $qb->setParameter(8, $params['kingdom']);
//        }
//
//
//        if (array_key_exists('phylum', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
//            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
//            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
//            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
//            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ?9');
//            $qb->setParameter(9, $params['phylum']);
//        }
//
//        if (array_key_exists('class', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
//            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
//            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
//            $qb->join('o.class', 'c', 'WITH', 'o.class = ?10');
//            $qb->setParameter(10, $params['class']);
//        }
//
//        if (array_key_exists('order', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
//            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
//            $qb->join('f.order', 'o', 'WITH', 'f.order = ?11');
//            $qb->setParameter(11, $params['order']);
//        }
//
//        if (array_key_exists('family', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = g.id');
//            $qb->join('g.family', 'f', 'WITH', 'g.family = ?12');
//            $qb->setParameter(12, $params['family']);
//        }
//
//        if (array_key_exists('genus', $params)) {
//            $qb->join('p.species', 's', 'WITH', 'p.species = s.id');
//            $qb->join('s.genus', 'g', 'WITH', 's.genus = ?13');
////            $qb->join('p.species', 's');
////            $qb->join('s.genus', 'g');
//            
//            //$qb->andWhere('g.genus = ?13');
//            $qb->setParameter(13, $params['genus']);
//        }
//

        
        
        $sql = $sql . " and st.locale = '". $locale."' ";
        $sql = $sql . " and lt.locale = '". $locale."' ";
        
        if ($order) {
            $sql = $sql . " order by p." . key($order) . " " . $order[key($order)];
        }

        if ($offset) {
            $sql = $sql . " offset " . $offset;
        }

        $sql = $sql . " limit " . $limit;
        
        return $sql;

    }

    public function findLikeName($string) {
        return $this->getEntityManager()->createQuery(
                        "SELECT p.id as id, p.title as title, p.description as description
            FROM SkaphandrusAppBundle:SkPhoto p
            WHERE p.title LIKE :string"
                )->setParameter('string', '%' . $string . '%')->getResult();
    }

}
