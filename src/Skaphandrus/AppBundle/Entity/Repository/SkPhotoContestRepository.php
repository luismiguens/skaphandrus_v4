<?php

namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SkPhotoContestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkPhotoContestRepository extends EntityRepository {

    public function findContestInProgress() {

        $query = $this->getEntityManager()->createQuery(
                        'SELECT c
            FROM SkaphandrusAppBundle:SkPhotoContest c
            WHERE c.winnersAt >= :today
            ORDER BY c.beginAt desc'
                )->setParameter('today', new \DateTime());

        return $query->getResult();
    }

    public function findContestEnded() {

        $query = $this->getEntityManager()->createQuery(
                        'SELECT c
            FROM SkaphandrusAppBundle:SkPhotoContest c
            WHERE c.winnersAt < :today
            ORDER BY c.beginAt desc'
                )->setParameter('today', new \DateTime());

        return $query->getResult();
    }

    public function getPhotographers($contest_id) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT distinct f.id as id, count(p.id) as num_photos
                FROM fos_user as f
                JOIN sk_photo as p
                on f.id = p.fos_user_id
                JOIN sk_photo_contest_category_photo as cat_pho
                ON p.id = cat_pho.photo_id
                JOIN sk_photo_contest_category as cat
                ON cat_pho.category_id = cat.id
                where cat.contest_id = " . $contest_id . " 
                group by id
                order by num_photos desc";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['id']);
            $user->setPhotosInContest($value['num_photos']);
            $result[] = $user;
        }

        return $result;
    }

    public function findPhotographers($contest) {

        $categories = $contest->getCategories();
        $users = array();

        foreach ($categories as $category) {
            foreach ($category->getPhoto() as $photo) {
                $user = $photo->getFosUser();

                if ($user && !array_key_exists($user->getId(), $users)) {
                    $users[$user->getId()] = $user;
                }
            }
        }

        return $users;
    }

    public function findPhotosFromUserNotAssociatedToContest($user_id, $contest_id) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT *
                FROM sk_photo as p
                WHERE p.fos_user_id = " . $user_id . " 
                AND p.id NOT IN( 
                    SELECT photo_id 
                    FROM sk_photo_contest_category_photo 
                    WHERE category_id IN (
                        SELECT id 
                        FROM sk_photo_contest_category 
                        WHERE contest_id = " . $contest_id . "))
                ORDER BY id DESC";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $photo = new \Skaphandrus\AppBundle\Entity\SkPhoto();
            $photo->setId($value['id']);
            $photo->setTitle($value['title']);
            $photo->setImage($value['image']);
            $result[] = $photo;
        }

        return $result;
    }

    public function findPhotosFromUserInCategory($user_id, $category_id) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $sql = "SELECT *
                FROM sk_photo
                JOIN sk_photo_contest_category_photo ON sk_photo.id = sk_photo_contest_category_photo.photo_id 
                WHERE sk_photo.fos_user_id = " . $user_id . " 
                AND sk_photo_contest_category_photo.category_id = " . $category_id . "
                ORDER BY sk_photo.id DESC";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
            $photo = new \Skaphandrus\AppBundle\Entity\SkPhoto();
            $photo->setId($value['id']);
            $photo->setTitle($value['title']);
            $photo->setImage($value['image']);
            $result[] = $photo;
        }

        return $result;
    }

    public function findPhotosFromUserInContest($user_id, $contest_id) {
        $categories = $this->getEntityManager()->createQuery(
                        'SELECT cat
            FROM SkaphandrusAppBundle:SkPhotoContestCategory cat
            WHERE IDENTITY(cat.contest) = :contest_id'
                )->setParameter('contest_id', $contest_id)->getResult();

        foreach ($categories as $category) {
            $photos[$category->getId()] = $this->findPhotosFromUserInCategory($user_id, $category->getId());
        }

        return $photos;
    }

    //para determinado utilizador e concurso devolve o numero de fotografias que são estreia numa especie
    public function findFirstPhotosFromSpeciesInContest($contest_id, $limit = 10) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare(
                "SELECT p.fos_user_id as user, count(p.id) as count_first_photo
                FROM sk_photo as p
                INNER JOIN (
                        SELECT id, species_id, MIN(created_at) AS first_photo 
                        FROM sk_photo GROUP BY species_id ) AS first_record 
                ON p.id = first_record.id
                JOIN sk_photo_contest_category_photo AS ca_photo 
                ON ca_photo.photo_id = p.id
                JOIN sk_photo_contest_category AS ca 
                ON ca.id = ca_photo.category_id
                WHERE ca.contest_id = :contest_id
                group by user
                order by count_first_photo desc 
                limit " . $limit . ""
        );

        $statement->bindValue('contest_id', $contest_id);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = new \Skaphandrus\AppBundle\Entity\FosUser();
            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['user']);
            $user->setFirstPhoto($value['count_first_photo']);
            $result[] = $user;
        }

        return $result;
    }

    //para determinado utilizador e concurso devolve o numero de fotografias com especie validada
    public function findValidatedSpeciesPhotosInContest($contest_id, $limit = 10) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $statement = $connection->prepare(
                "SELECT p.fos_user_id as user, count(p.id) as count_photo_species_valid
                FROM sk_photo AS p
                JOIN sk_photo_contest_category_photo AS ca_photo 
                ON ca_photo.photo_id = p.id
                JOIN sk_photo_contest_category AS ca 
                ON ca.id = ca_photo.category_id
                WHERE ca.contest_id = :contest_id AND (p.species_id <> 0 OR p.species_id is not null) 
                group by user
                order by count_photo_species_valid desc
                limit " . $limit . ""

//                "SELECT p.fos_user_id as user, count(p.id) as count_photo_species_valid
//                FROM sk_photo AS p
//                INNER JOIN ( 
//                        SELECT photo_id, species_id, count(species_id) as soma 
//                        FROM sk_photo_species_validation group by photo_id, species_id) AS validated_record 
//                ON p.id = validated_record.photo_id 
//                JOIN sk_photo_contest_category_photo AS ca_photo 
//                ON ca_photo.photo_id = p.id
//                JOIN sk_photo_contest_category AS ca 
//                ON ca.id = ca_photo.category_id
//                WHERE ca.contest_id = :contest_id
//                group by user
//                order by count_photo_species_valid desc
//                limit " . $limit . ""
        );

        $statement->bindValue('contest_id', $contest_id);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = new \Skaphandrus\AppBundle\Entity\FosUser();
            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['user']);
            $user->setValidSpeciesPhoto($value['count_photo_species_valid']);
            $result[] = $user;
        }

        return $result;
    }

    //para determinado utilizador e concurso devolve o numero de especies com validação
    public function findValidatedSpeciesInContest($contest_id, $limit = 10) {

        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare(
                "SELECT p.fos_user_id as user, count(distinct(p.species_id)) as count_species_validated
                FROM sk_photo AS p
                JOIN sk_photo_contest_category_photo AS ca_photo 
                ON ca_photo.photo_id = p.id
                JOIN sk_photo_contest_category AS ca 
                ON ca.id = ca_photo.category_id
                WHERE ca.contest_id = :contest_id AND (p.species_id <> 0 OR p.species_id is not null) 
                group by user
                order by count_species_validated desc
                limit " . $limit . ""

//                "SELECT p.fos_user_id as user, count(sv.species_id) AS count_species_validated
//                FROM sk_photo_species_validation AS sv
//                JOIN sk_photo AS p 
//                ON p.id = sv.photo_id
//                JOIN sk_photo_contest_category_photo AS ca_p
//                ON p.id = ca_p.photo_id 
//                JOIN sk_photo_contest_category AS ca 
//                ON ca_p.category_id = ca.id
//                WHERE ca.contest_id = :contest_id
//                group by user
//                order by count_species_validated desc
//                limit " . $limit . ""
        );

        $statement->bindValue('contest_id', $contest_id);
        $statement->execute();
        $values = $statement->fetchAll();
        $result = array();

        foreach ($values as $value) {
//            $user = new \Skaphandrus\AppBundle\Entity\FosUser();
            $user = $em->getRepository('SkaphandrusAppBundle:FosUser')->find($value['user']);
            $user->setValidSpecies($value['count_species_validated']);
            $result[] = $user;
        }

        return $result;
    }

}
