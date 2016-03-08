<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;
use Skaphandrus\AppBundle\Entity\FosUser;

/**
 * SkPhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FosUserRepository extends EntityRepository {

    public function getMorePhotographers($location_id, $limit = 3, $offset = 0) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname,
                st.photo as photo,
                count(p.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_settings as st
                on u.id = st.fos_user_id
                JOIN sk_photo as p
                on u.id = p.fos_user_id
                JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_location as l
                ON l.id = s.location_id
                where l.id = " . $location_id . "
                group by id
                order by photosInUser desc
                limit " . $limit . "
                offset " . $offset;

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['id']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $settings = new \Skaphandrus\AppBundle\Entity\SkSettings();
            $settings->setPhoto($value['photo']);

            $user->setPersonal($personal);
            $user->setSettings($settings);

            $result[] = $user;
        }

        return $result;
    }

    public function findPhotos($fosUser_id, $location_id) {
        $query = $this->getEntityManager()->createQuery(
                        'SELECT p
            FROM SkaphandrusAppBundle:SkPhoto p
            JOIN p.spot s
            JOIN s.location l
            WHERE p.fosUser = :fosUser_id and l.id = :location_id'
                )->setParameter('fosUser_id', $fosUser_id)->setParameter('location_id', $location_id)->setMaxResults(6);

        return $query->getResult();
    }

//    public function isJudgeInCategory($category_id, $fos_user_id) {
//        $em = $this->getEntityManager();
//        $connection = $em->getConnection();
//
//        $sql = "select u.id as user 
//                from fos_user as u
//                join sk_photo_contest_judge as j on u.id = j.fos_user_id
//                join sk_photo_contest_judge_award as ja on j.id = ja.judge_id
//                join sk_photo_contest_award as a on a.id = ja.award_id
//                where a.category_id = " . $category_id . " and u.id =" . $fos_user_id;
//
//        $statement = $connection->prepare($sql);
//        $statement->execute();
//        $values = $statement->fetchAll();
//
////        $result = $values->getQuery()->getResult();
//        // dump($result);
//
//        if ($values):
//            return true;
//        endif;
//    }

    /** WORKAROUND - ARENÇÃO ESTE METODO TEM DE SER ALTERADO * */
    public function isJudge($fos_user_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $sql = "select u.id 
                from sk_photo_contest_judge as j
                join fos_user as u 
                on u.id = j.fos_user_id
                where u.id =" . $fos_user_id;
        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
//        $result = $values->getQuery()->getResult();
        if ($values):
            return true;
        endif;
    }

    public function getQueryBuilder($params, $limit = 20, $order = array('id' => 'desc'), $offset = 0) {


        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('u')->from('SkaphandrusAppBundle:FosUser', 'u');
        $qb->leftJoin('u.photos', 'p', 'WITH', 'p.fosUser = u.id');

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
            $qb->setParameter(13, $params['genus']);
        }

//        if ($order) {
//            $qb->orderBy('p.'.key($order), $order[key($order)]);
//        }
//
//        if ($offset) {
//            $qb->setFirstResult($offset);
//        }
//        
//       
//            $qb->setMaxResults($limit);
//echo $qb;

        return $qb;
    }

    public function findWithPhotoCountByTaxon($next_taxon, $taxon_name, $taxon_id, $limit = 20) {

//        dump($taxon_name);
//        dump($taxon_id);
//        

        $query = $this->getEntityManager()
                ->createQuery(
                        'SELECT u as user, COUNT(photo.id) as photosInUser
                FROM SkaphandrusAppBundle:FosUser u
                JOIN SkaphandrusAppBundle:SkPhoto photo WITH u.id = IDENTITY(photo.fosUser)
                JOIN photo.species s
                JOIN s.genus g
                JOIN g.family f
                JOIN f.order o
                JOIN o.class c
                JOIN c.phylum p 
                JOIN p.kingdom k
                WHERE ' . substr($taxon_name, 0, 1) . '.id = :taxon_id 
                GROUP BY u.id
                ORDER BY photosInUser DESC'
                )->setParameter('taxon_id', $taxon_id)
                ->setMaxResults($limit);
//        dump($query->getDQL());
        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getPhotosInContest($contest_id, $user_id) {

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

//        $queryBuilder
//            ->select('pho')
//            ->from('SkaphandrusAppBundle:SkPhotoContest', 'con')
//            ->innerJoin('con', 'SkaphandrusAppBundle:SkPhotoContestCategory', 'cat', 'con.id = cat.contest_id')
//            ->innerJoin('cat', 'SkaphandrusAppBundle:SkPhoto', 'pho', 'cat.id = pho.id')
//            ->where( 'pho.fos_user_id :user_id')
//            ->andWhere('con.id :contest_id')
//            ->setParameter('user_id',  $user_id)
//            ->setParameter('contest_id',  $contest_id);    
//        
//        $qb->select('u')
//                ->from('SkaphandrusAppBundle:FosUser', 'u');
//        $qb->leftJoin('u.photos', 'p', 'WITH', 'p.fosUser = u.id');

        $queryBuilder->select('p')
                ->from('SkaphandrusAppBundle:SkPhoto', 'p')
                ->join('p.category', 'c')
                ->join('c.contest', 'ct')
                ->where('p.fosUser = ?1')
                ->andWhere('c.contest = ?2')
                ->setParameter(1, $user_id)
                ->setParameter(2, $contest_id);

        $photosInContest = $queryBuilder->getQuery()->getResult();
        return $photosInContest;
    }

    public function findAllUsersLite() {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as user_id
                FROM fos_user as u
                group by user_id 
                order by user_id asc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $user = new FosUser();
            $user->setId($value['user_id']);

            $result[] = $user;
        }

        return $result;
    }

    //Esta a ser usado na pagina user home
    public function findAllUsers() {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT * from sk_user as u
                order by photos desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        return $values;
    }

    public function getUserValidations($fos_user_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT v.species_id AS species, count(v.photo_id) AS count, 
                sn.name as species_name, sn.author as species_author
                FROM sk_photo_species_validation AS v
                JOIN sk_species as s ON s.id = v.species_id
                JOIN sk_species_scientific_name AS sn ON s.id = sn.species_id
                WHERE v.fos_user_id = " . $fos_user_id . "
                GROUP BY v.species_id
                ORDER BY count desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        return $values;
    }

    public function getUserSugestions($fos_user_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT su.species_id AS species, count(su.photo_id) AS count,
                sn.name as species_name, sn.author as species_author
                FROM sk_photo_species_sugestion as su
                Join sk_species as s on s.id = su.species_id
                Join sk_species_scientific_name as sn on s.id = sn.species_id
                WHERE su.fos_user_id = " . $fos_user_id . "
                GROUP BY su.species_id
                ORDER BY count desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        return $values;
    }

    public function findAllUsers_to_delete() {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, 
                up.middlename as middlename, up.lastname as lastname,
                st.photo as photo,
                st.points as points,
                count(distinct(ph.species_id)) as species,
                count(ph.id) as photosInUser,
                (select count(species_id) 
                from sk_photo_species_validation
                where fos_user_id = u.id
                ) as validation,
                (select count(species_id) 
                from sk_photo_species_sugestion
                where fos_user_id = u.id
                ) as sugestion
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_settings as st
                on u.id = st.fos_user_id
                left JOIN sk_photo as ph
                on u.id = ph.fos_user_id
                group by id
                order by validation desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);
            $user->setSpeciesInUser($value['species']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $settings = new \Skaphandrus\AppBundle\Entity\SkSettings();
            $settings->setPhoto($value['photo']);
            $settings->setPoints($value['points']);

            $user->setPersonal($personal);
            $user->setSettings($settings);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInCountry($country_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname, 
                count(p.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_photo as p
                on u.id = p.fos_user_id
                JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_location as l
                ON l.id = s.location_id
                JOIN sk_region as r
                ON l.region_id = r.id
                JOIN sk_country as c
                ON r.country_id = c.id
                where c.id = " . $country_id . "
                group by id
                order by photosInUser desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['fosUser']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $user->setPersonal($personal);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInCountry_to_delete($country_id) {
        $query = $this->getEntityManager()->createQuery(
                        "SELECT u as fosUser, COUNT(photo.id) as photosInUser
                FROM SkaphandrusAppBundle:FosUser u
                JOIN SkaphandrusAppBundle:SkPhoto photo WITH u.id = photo.fosUser
                JOIN photo.spot s
                JOIN s.location l
                JOIN l.region r
                WHERE r.country = :country_id
                GROUP BY u.id
                order by photosInUser desc"
                )->setParameter('country_id', $country_id);

        foreach ($query->getResult() as $value) {
            $value['fosUser']->setPhotosInUser($value['photosInUser']);
            $result[] = $value['fosUser'];
        }

        try {
            return $result;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findUsersInCountry2_to_delete($country_id) {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('u as fosUser')
                ->addSelect('Count(p.id) as photosInUser')
                ->from('SkaphandrusAppBundle:FosUser', 'u')
                //users
                ->join('u.photos', 'p', 'WITH', 'p.fosUser = u.id')
                //spots, locations, regions and countries
                ->join('p.spot', 's', 'WITH', 'p.spot = s.id')
                ->join('s.location', 'l', 'WITH', 's.location = l.id')
                ->join('l.region', 'r', 'WITH', 'l.region = r.id')
                ->join('r.country', 'c', 'WITH', 'r.country = ?1')
                ->groupBy('u.id')
                ->setParameter(1, $country_id);

        $result = $qb->getQuery()->getResult();

        return $result;
    }

    public function findUsersInLocation($location_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname, 
                count(p.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_photo as p
                on u.id = p.fos_user_id
                JOIN sk_spot as s
                on s.id = p.spot_id
                JOIN sk_location as l
                ON l.id = s.location_id
                where l.id = " . $location_id . "
                group by id
                order by photosInUser desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['fosUser']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $user->setPersonal($personal);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInSpot($spot_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname, 
                count(p.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_photo as p
                on u.id = p.fos_user_id
                JOIN sk_spot as s
                on s.id = p.spot_id
                where s.id = " . $spot_id . "
                group by id
                order by photosInUser desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['fosUser']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $user->setPersonal($personal);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInSpecies($species_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname, 
                count(p.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_photo as p
                on u.id = p.fos_user_id
                JOIN sk_species as sp
                on sp.id = p.species_id
                where sp.id = " . $species_id . "
                group by id
                order by photosInUser desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['fosUser']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $user->setPersonal($personal);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInTaxon($next_taxon, $taxon_name, $taxon_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT u.id as id, u.username as username, 
                up.id as p_id, up.firstname as firstname, up.middlename as middlename, up.lastname as lastname, 
                count(pho.id) as photosInUser 
                FROM fos_user as u
                JOIN sk_personal as up
                on u.id = up.fos_user_id
                JOIN sk_photo as pho
                on u.id = pho.fos_user_id
                JOIN sk_species as sp
                on sp.id = pho.species_id
                JOIN sk_genus as g
                on g.id = sp.genus_id
                JOIN sk_family as f
                on f.id = g.family_id
                JOIN sk_order as o
                on o.id = f.order_id
                JOIN sk_class as c
                on c.id = o.class_id
                JOIN sk_phylum as p
                on p.id = c.phylum_id
                JOIN sk_kingdom as k
                on k.id = p.kingdom_id
                where " . substr($taxon_name, 0, 1) . ".id = " . $taxon_id . "
                group by u.id
                order by photosInUser desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['id']);

            $user = new FosUser();
            $user->setId($value['id']);
            $user->setUsername($value['username']);
            $user->setPhotosInUser($value['photosInUser']);

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($value['firstname']);
            $personal->setMiddlename($value['middlename']);
            $personal->setLastname($value['lastname']);

            $user->setPersonal($personal);

            $result[] = $user;
        }

        return $result;
    }

    public function findUsersInTaxon_to_delete($next_taxon, $taxon_name, $taxon_id) {

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('SkaphandrusAppBundle:FosUser', 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'username', 'username');
//        $rsm->addFieldResult('u', 'photosInUser', 'photosInUser');
//        $rsm->addScalarResult('photosInUser', 'photosInUser');
//        $rsm->addJoinedEntityResult('SkaphandrusAppBundle:SkPersonal', 'up', 'u', 'personal');
//        $rsm->addFieldResult('up', 'id', 'id');
//        $rsm->addFieldResult('up', 'fos_user_id', 'fosUser');
//        $rsm->addMetaResult('u', 'personal', 'address_id');
//        $rsm->addFieldResult('up', 'firstname', 'firstname');
//        $rsm->addFieldResult('up', 'middlename', 'middlename');
//        $rsm->addFieldResult('up', 'lastname', 'lastname');

        $query = $this->getEntityManager()->createNativeQuery(
                "SELECT u.id, u.username, COUNT(pho.id) as count
                    FROM fos_user as u
                    JOIN sk_personal as up
                    on u.id = up.fos_user_id
                    JOIN sk_photo as pho
                    on u.id = pho.fos_user_id
                    JOIN sk_species as sp
                    on sp.id = pho.species_id
                    JOIN sk_genus as g
                    on g.id = sp.genus_id
                    JOIN sk_family as f
                    on f.id = g.family_id
                    JOIN sk_order as o
                    on o.id = f.order_id
                    JOIN sk_class as c
                    on c.id = o.class_id
                    JOIN sk_phylum as p
                    on p.id = c.phylum_id
                    JOIN sk_kingdom as k
                    on k.id = p.kingdom_id
                    where k.id = ?
                    group by u.id", $rsm);

        //" . substr($taxon_name, 0, 1) . "
//        dump($query);

        $query->setParameter(1, $taxon_id);

        $values = $query->getResult();

//        dump($values);
//         foreach ($values as $user) {
//            //$user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['user']);
//            $user->setPhotosInUser($value['photosInUser']);
//            $result[] = $user;
//        }

        return $query->getResult();
    }

    public function isFosUserJudgeInContest($fos_user_id, $contest_id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "select u.id as user 
                from fos_user as u
                join sk_photo_contest_judge as j on u.id = j.fos_user_id
                join sk_photo_contest_judge_contest as jc on j.id = jc.judge_id
                where jc.contest_id = " . $contest_id . " and u.id =" . $fos_user_id;

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

//        $result = $values->getQuery()->getResult();
        // dump($result);

        if ($values):
            return true;
        else:
            return false;
        endif;
    }

}
