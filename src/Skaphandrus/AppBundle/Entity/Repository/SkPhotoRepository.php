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

    public function changePhotoToPrimary($photo_id, $species_id) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();


        //update old photo, set is_primary = false
        $sql = "update sk_photo set is_primary = 0 where species_id = " . $species_id . "";
        $statement = $connection->prepare($sql);
        $statement->execute();

        //update new photo, set is_primary = true
        $sql = "update sk_photo set is_primary = 1 where id = " . $photo_id . "";
        $statement = $connection->prepare($sql);
        $statement->execute();

        return true;
    }

    public function setPoints($photo_id, $category_id) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT vote.photo_id as photo_id, sum(vote.points) as points 
                FROM sk_photo_contest_category_judge_photo_vote as vote 
                JOIN sk_photo_contest_category_judge_votation as votation on vote.votation_id = votation.id 
                WHERE category_id = " . $category_id . " and photo_id = " . $photo_id . "
                group by photo_id";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $value = $statement->fetchColumn(1);

        return $value;
    }

    public function findNextPhoto($id) {
        return $this->getEntityManager()->createQuery(
                        "SELECT p FROM SkaphandrusAppBundle:SkPhoto p
            WHERE p.id > :id ORDER BY p.id ASC "
                )->setParameter('id', $id)->setMaxResults(1)->getOneOrNullResult();
    }

    public function findPreviousPhoto($id) {
        return $this->getEntityManager()->createQuery(
                        "SELECT p FROM SkaphandrusAppBundle:SkPhoto p
            WHERE p.id < :id ORDER BY p.id DESC "
                )->setParameter('id', $id)->setMaxResults(1)->getOneOrNullResult();
    }

    public function getPhotosFromUser($fosUser) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT id from sk_photo where fos_user_id = " . $fosUser->getId();

        $statement = $connection->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll();

        //ir buscar os ids das fotografias dos utilizadores
        foreach ($array as $key => $value) {
            $photo_ids[] = $value['id'];
        }

        //baralhar os id's
        shuffle($photo_ids);


        //ir buscar apenas 6 depois de baralhar
        for ($i = 0; $i <= 9 && $i < count($photo_ids); $i++):
            $photos[] = $photo_ids[$i];
        endfor;

        $qb = $em->createQueryBuilder('p');

        //ir buscar os objectos photos
        $photos = $em->createQuery('SELECT p FROM SkaphandrusAppBundle:SkPhoto p '
                        . 'WHERE ' . $qb->expr()->in('p.id', $photos))->getResult();


        return $photos;
    }

    public function getPhotoSimilarSpecies($species) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT p.id as id, ss.name
                from sk_photo as p
                join sk_species as s on p.species_id = s.id
                join sk_species_scientific_name as ss on s.id = ss.species_id
                join sk_genus as g on g.id = s.genus_id
                join sk_family as f on f.id = g.family_id
                join sk_order as o on o.id = f.order_id
                where o.id = " . $species->getGenus()->getFamily()->getOrder()->getId() . "
                group by ss.name";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll();

        //ir buscar os ids das fotografias dos utilizadores
        foreach ($array as $key => $value) {
            $photo_ids[] = $value['id'];
        }

        //baralhar os id's
        shuffle($photo_ids);


        //ir buscar apenas 6 depois de baralhar
        for ($i = 0; $i <= 9 && $i < count($photo_ids); $i++):
            $photos[] = $photo_ids[$i];
        endfor;

        $qb = $em->createQueryBuilder('p');

        //ir buscar os objectos photos
        $photos = $em->createQuery('SELECT p FROM SkaphandrusAppBundle:SkPhoto p '
                        . 'WHERE ' . $qb->expr()->in('p.id', $photos))->getResult();


        return $photos;
    }

//    public function getPhotoInContest($photo_id, $locale) {
//
//        $em = $this->getEntityManager();
//        $connection = $em->getConnection();
//
//        $sql = "SELECT contest, category, photo_id, sum(points) as points 
//                FROM (
//                    SELECT c.name as contest, cct.name as category, votation.category_id, votation.judge_id, vote.photo_id as photo_id, vote.points as points, votation.id 
//                    FROM sk_photo_contest_category_judge_photo_vote as vote 
//                    JOIN sk_photo_contest_category_judge_votation as votation on vote.votation_id = votation.id 
//                    JOIN sk_photo_contest_category as cc on votation.category_id = cc.id
//                    JOIN sk_photo_contest_category_translation cct on cct.translatable_id  = cc.id
//                    JOIN sk_photo_contest c on cc.contest_id = c.id
//                    WHERE photo_id = " . $photo_id . " and cct.locale = '" . $locale . "') as somatorio 
//                GROUP by photo_id 
//                HAVING points > 0 
//                ORDER by points desc";
//
//        $statement = $connection->prepare($sql);
//        $statement->execute();
//        $values = $statement->fetchAll();
////        $result = array();
////
////        foreach ($values as $value) {
////
////            $contest = new \Skaphandrus\AppBundle\Entity\SkPhotoContest();
////            $contest->setName($value['c']);
////
////            $category = new \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory();
////            $category->translate($locale)->setName($value['category']);
////            $category->setContest($contest);
////
////            $photo = new \Skaphandrus\AppBundle\Entity\SkPhoto();
////            $photo = $em->getRepository('SkaphandrusAppBundle:SkPhoto')->find($value['photo_id']);
////            $photo->setPoints($value['points']);
////            $photo->addCategory($category);
////            $result[] = $photo;
////        }
//
//        return $values;
//    }


    public function getCategories($photo_id) {


        return $this->getEntityManager()->createQuery(
                        "SELECT c FROM SkaphandrusAppBundle:SkPhotoContestCategory c
                            LEFT JOIN SkaphandrusAppBundle:SkPhoto p
                            WHERE p.id > :id ORDER BY p.id ASC "
                )->setParameter('id', $photo_id)->getResult();
    }

    public function getPhotoInContest($photo_id, $locale) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT c.name as contest, cct.name as category_name
                FROM sk_photo_contest_category as cc
                JOIN sk_photo_contest_category_translation as cct on cc.id = cct.translatable_id
                JOIN sk_photo_contest as c on cc.contest_id = c.id
                JOIN sk_photo_contest_category_photo as ccp on cc.id = ccp.category_id
                where ccp.photo_id = " . $photo_id . " and cct.locale = '" . $locale . "'";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {

            $contest = new \Skaphandrus\AppBundle\Entity\SkPhotoContest();
            $contest->setName($value['contest']);

            $category = new \Skaphandrus\AppBundle\Entity\SkPhotoContestCategory();
            $category->translate($locale)->setName($value['category_name']);
            $category->setContest($contest);

            $result[] = $category;
        }

        return $result;
    }

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
    public function getQueryBuilder4($params, $limit = 30, $order = array('validatedRating' => 'desc'), $offset = 0) {

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
            //$qb->join('p.species', 's');
            //$qb->join('s.genus', 'g');
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

        return $qb;
    }

    public function getQueryBuilderForGallery($locale, $params, $limit = 30, $order = array('validatedRating' => 'desc'), $offset = 0) {

        /**
         * query utilizado na galeria de fotografias
         * regras: sempre que dois campos da mesma area estão preenchidos tomar em consideração apenas o mais baixo
         * ex: location=faro, spot navio dori = apenas considerar navio dori
         */
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')->from('SkaphandrusAppBundle:SkPhoto', 'p');

        //USERS        
        if (array_key_exists('fosUser', $params)) {
            $qb->andWhere('p.fosUser = ?1');
            $qb->setParameter(1, $params['fosUser']);
        }

        //-- GEOGRAPHIC --
        //spot id
        if (array_key_exists('spot', $params)) {
            $qb->andWhere('p.spot = ?3');
            $qb->setParameter(3, $params['spot']);
        }

        //spot name
        if (array_key_exists('spotName', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.translations', 'st');
            $qb->andWhere('st.name LIKE ?2');
            $qb->setParameter(2, "%" . $params['spotName'] . "%");
        }

        //autocomplete
        elseif (array_key_exists('location', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->andWhere('s.location = ?4');
            $qb->setParameter(4, $params['location']);
        }

        //autocomplete
        elseif (array_key_exists('region', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
            $qb->join('l.region', 'r', 'WITH', 'l.region = ?5');
            $qb->setParameter(5, $params['region']);
        }

        //autocomplete
        //country name
        elseif (array_key_exists('countryName', $params)) {
            $em = $this->getEntityManager();
            $country_ids = $em->getRepository('SkaphandrusAppBundle:SkCountry')->findCountryDestinations($params['countryName'], $locale);

            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
            $qb->join('r.country', 'c', 'WITH', 'r.country = ?6');
            $qb->setParameter(6, implode(', ', $country_ids));
        }

        //country id
        if (array_key_exists('country', $params)) {
            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
            $qb->join('r.country', 'c', 'WITH', 'r.country = ?6');
            $qb->setParameter(6, $params['country']);
        }

        //MARINE SPECIES
        //common names text
        if (array_key_exists('vernacular', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.species_vernaculars', 'sv');
            $qb->join('sv.vernacular', 'v');
            $qb->andWhere('v.name LIKE ?7');
            $qb->setParameter(7, '%' . $params['vernacular'] . '%');
        }

        //autocomplete
        elseif (array_key_exists('species', $params)) {
            $qb->andWhere('p.species = ?8');
            $qb->setParameter(8, $params['species']);
        }

        //autocomplete
        elseif (array_key_exists('genus', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = ?9');
            $qb->setParameter(9, $params['genus']);
        }

        //autocomplete
        elseif (array_key_exists('family', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = ?10');
            $qb->setParameter(10, $params['family']);
        }

        //autocomplete
        elseif (array_key_exists('order', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = ?11');
            $qb->setParameter(11, $params['order']);
        }

        //autocomplete
        elseif (array_key_exists('class', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = ?12');
            $qb->setParameter(12, $params['class']);
        }

        //autocomplete
        elseif (array_key_exists('phylum', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ?13');
            $qb->setParameter(13, $params['phylum']);
        }

        //autocomplete
        elseif (array_key_exists('kingdom', $params)) {
            $qb->join('p.species', 'sp', 'WITH', 'p.species = sp.id');
            $qb->join('sp.genus', 'g', 'WITH', 'sp.genus = g.id');
            $qb->join('g.family', 'f', 'WITH', 'g.family = f.id');
            $qb->join('f.order', 'o', 'WITH', 'f.order = o.id');
            $qb->join('o.class', 'c', 'WITH', 'o.class = c.id');
            $qb->join('c.phylum', 'ph', 'WITH', 'c.phylum = ph.id');
            $qb->join('ph.kingdom', 'k', 'WITH', 'ph.kingdom = ?14');
            $qb->setParameter(14, $params['kingdom']);
        }

        if ($order) {
            $qb->orderBy('p.' . key($order), $order[key($order)]);
        }

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        $qb->setMaxResults($limit);

        //dump($qb->getQuery());

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

//        dump($photos);

        return $photos;
    }

    public function getQueryForGrid($params, $limit = 25, $order = array('id' => 'desc'), $offset = 0, $locale = "en") {

//        $sql = "SELECT p.id as photo_id, p.title as photo_title, p.image as photo_image, "
//                . "p.created_at as photo_created_at, p.taken_at as photo_taken_at, "
//                . "f.id as fos_user_id, f.username as fos_user_username, "
//                . "fp.id as personal_id, fp.firstname as personal_firstname, fp.middlename as personal_middlename, fp.lastname as personal_lastname, "
//                . "s.id as spot_id, st.name as spot_name, "
//                . "l.id as location_id, lt.name as location_name "
//                . "FROM sk_photo as p "
//                . "JOIN fos_user as f on f.id = p.fos_user_id "
//                . "JOIN sk_personal as fp on f.id = fp.fos_user_id "
//                . "LEFT JOIN sk_spot as s on p.spot_id = s.id "
//                . "JOIN sk_spot_translation as st on s.id = st.translatable_id "
//                . "LEFT JOIN sk_location as l on s.location_id = l.id "
//                . "JOIN sk_location_translation as lt on l.id = lt.translatable_id ";


        $sql = "SELECT p.id as photo_id, p.title as photo_title, p.image as photo_image, "
                . "p.created_at as photo_created_at, p.taken_at as photo_taken_at, "
                . "f.id as fos_user_id, f.username as fos_user_username, "
                . "fp.id as personal_id, fp.firstname as personal_firstname, fp.middlename as personal_middlename, fp.lastname as personal_lastname "
                . "FROM sk_photo as p "
                . "JOIN fos_user as f on f.id = p.fos_user_id "
                . "JOIN sk_personal as fp on f.id = fp.fos_user_id ";


        //users
        if (array_key_exists('fosUser', $params)) {
            $sql = $sql . ' where p.fos_user_id = ' . $params['fosUser'];
        }

        //spots, locations, regions and countries
        if (array_key_exists('spot', $params)) {
            $sql = $sql . ' where p.spot_id = ' . $params['spot'];
        }

        if (array_key_exists('location', $params)) {
            $sql = $sql . "LEFT JOIN sk_spot as s on p.spot_id = s.id "
                    . "JOIN sk_spot_translation as st on s.id = st.translatable_id "
                    . "LEFT JOIN sk_location as l on s.location_id = l.id "
                    . "JOIN sk_location_translation as lt on l.id = lt.translatable_id ";
            $sql = $sql . ' where s.location_id = ' . $params['location'];
            $sql = $sql . " and st.locale = '" . $locale . "' ";
            $sql = $sql . " and lt.locale = '" . $locale . "' ";
        }

        if (array_key_exists('country', $params)) {
            $sql = $sql . "LEFT JOIN sk_spot as s on p.spot_id = s.id "
                    . "JOIN sk_spot_translation as st on s.id = st.translatable_id "
                    . "LEFT JOIN sk_location as l on s.location_id = l.id "
                    . "JOIN sk_location_translation as lt on l.id = lt.translatable_id ";
            $sql = $sql . "JOIN sk_region as r on l.region_id = r.id ";
            $sql = $sql . ' where r.country_id = ' . $params['country'];
            $sql = $sql . " and st.locale = '" . $locale . "' ";
            $sql = $sql . " and lt.locale = '" . $locale . "' ";
        }


        //species, genus, families, orders, classes, kingdoms
        if (array_key_exists('species', $params)) {
            $sql = $sql . ' where p.species_id = ' . $params['species'];
        }

        if (array_key_exists('kingdom', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . "JOIN sk_genus as g on sp.genus_id = g.id ";
            $sql = $sql . "JOIN sk_family as fa on g.family_id = fa.id ";
            $sql = $sql . "JOIN sk_order as o on fa.order_id = o.id ";
            $sql = $sql . "JOIN sk_class as c on o.class_id = c.id ";
            $sql = $sql . "JOIN sk_phylum as ph on c.phylum_id = ph.id ";
            $sql = $sql . ' where ph.kingdom_id = ' . $params['kingdom'];
        }

        if (array_key_exists('phylum', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . "JOIN sk_genus as g on sp.genus_id = g.id ";
            $sql = $sql . "JOIN sk_family as fa on g.family_id = fa.id ";
            $sql = $sql . "JOIN sk_order as o on fa.order_id = o.id ";
            $sql = $sql . "JOIN sk_class as c on o.class_id = c.id ";
            $sql = $sql . ' where c.phylum_id = ' . $params['phylum'];
        }

        if (array_key_exists('class', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . "JOIN sk_genus as g on sp.genus_id = g.id ";
            $sql = $sql . "JOIN sk_family as fa on g.family_id = fa.id ";
            $sql = $sql . "JOIN sk_order as o on fa.order_id = o.id ";
            $sql = $sql . ' where o.class_id = ' . $params['class'];
        }

        if (array_key_exists('order', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . "JOIN sk_genus as g on sp.genus_id = g.id ";
            $sql = $sql . "JOIN sk_family as fa on g.family_id = fa.id ";
            $sql = $sql . ' where fa.order_id = ' . $params['order'];
        }

        if (array_key_exists('family', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . "JOIN sk_genus as g on sp.genus_id = g.id ";
            $sql = $sql . ' where g.family_id = ' . $params['family'];
        }

        if (array_key_exists('genus', $params)) {
            $sql = $sql . "JOIN sk_species as sp on p.species_id = sp.id ";
            $sql = $sql . ' where sp.genus_id = ' . $params['genus'];
        }

//        $sql = $sql . " and st.locale = '" . $locale . "' ";
//        $sql = $sql . " and lt.locale = '" . $locale . "' ";

        if ($order) {
            $sql = $sql . " order by p." . key($order) . " " . $order[key($order)];
        }

        if ($offset) {
            $sql = $sql . " offset " . $offset;
        }

        $sql = $sql . " limit " . $limit;

//        dump($sql);

        return $sql;
    }

    public function findLikeName($string) {
        return $this->getEntityManager()->createQuery(
                        "SELECT p.id as id, p.title as title, p.description as description
            FROM SkaphandrusAppBundle:SkPhoto p
            WHERE p.title LIKE :string"
                )->setParameter('string', '%' . $string . '%')->getResult();
    }

    public function countPointsFromPublicInCategory($photo_id, $category_id) {

        $result = $this->getEntityManager()
                        ->createQuery(
                                "SELECT COUNT(p.photo) as countable
            FROM SkaphandrusAppBundle:SkPhotoContestVote p
            WHERE p.photo = :photo_id AND p.category = :category_id
            GROUP BY p.photo"
                        )->setParameter('photo_id', $photo_id)->setParameter('category_id', $category_id)->getOneOrNullResult();

        if ($result):
            return $result['countable'];
        else:
            return 0;
        endif;
    }

    //utilizado na pagina de admin de fotografias
    public function getUserPhotos($fos_user, $params, $limit = 21, $order = array('createdAt' => 'desc'), $offset = 0) {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')->from('SkaphandrusAppBundle:SkPhoto', 'p');
        $qb->where('p.fosUser = ?1');
        $qb->setParameter(1, $fos_user);

        //contest
        if (array_key_exists('contest', $params)) {
            $qb->join('p.category', 'ca');
            $qb->andWhere('ca.contest = ?2');
            $qb->setParameter(2, $params['contest']);
        }

        //species
        if (array_key_exists('species', $params)) {
            $qb->andWhere('p.species = ?3');
            $qb->setParameter(3, $params['species']);
        }

        //tags
        if (array_key_exists('tag', $params)) {
            $qb->join('p.keyword', 'k');
            $qb->andWhere('k.id = ?4');
            $qb->setParameter(4, $params['tag']);
        }

        if ($order) {
            $qb->orderBy('p.' . key($order), $order[key($order)]);
        }

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        $qb->setMaxResults($limit);

//        dump($qb);

        return $qb;
    }

    //utilizado na pagina de admin de fotografias
    public function getUserSpeciesFromPhotos($fos_user) {

        return $this->getEntityManager()->createQuery(
                        "SELECT sn
                FROM SkaphandrusAppBundle:SkSpeciesScientificName sn
                JOIN SkaphandrusAppBundle:SkSpecies s WITH sn.species = s.id
                JOIN SkaphandrusAppBundle:SkPhoto p WITH p.species = s.id
                WHERE p.fosUser = ?1
                GROUP BY p.id
                ORDER BY sn.name ASC"
                )->setParameter(1, $fos_user)->getResult();
    }

    //utilizado na pagina de admin de fotografias
    public function getUserTagsFromPhotos($fos_user) {

        return $this->getEntityManager()->createQuery(
                        "SELECT k
                FROM SkaphandrusAppBundle:SkKeyword k 
                JOIN k.photo p
                WHERE p.fosUser = ?1 
                GROUP BY k.id
                ORDER BY k.keyword ASC"
                )->setParameter(1, $fos_user)->getResult();
    }

}
