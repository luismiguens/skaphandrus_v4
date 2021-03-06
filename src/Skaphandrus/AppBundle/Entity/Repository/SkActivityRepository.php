<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Skaphandrus\AppBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;



/**
 * Description of SkActivityRepository
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */
class SkActivityRepository extends EntityRepository {
    //put your code here
    
    
      public function getQueryBuilder($params, $limit=20, $order = array('createdAt' => 'desc'), $offset=0) {


        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')->from('SkaphandrusAppBundle:SkActivity', 'p');

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

        
        if (array_key_exists('message_name', $params)) {
            $qb->andWhere('p.message_name IN ( ?3 )');
            $qb->setParameter(3, $params['message_name']);
        }

        
        
        
//        if (array_key_exists('location', $params)) {
//            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
//            $qb->join('s.location', 'l', 'WITH', 's.location = ?4');
//            $qb->setParameter(4, $params['location']);
//        }
//
//        if (array_key_exists('region', $params)) {
//            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
//            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
//            $qb->join('l.region', 'r', 'WITH', 'l.region = ?5');
//            $qb->setParameter(5, $params['region']);
//        }
//
//        if (array_key_exists('country', $params)) {
//            $qb->join('p.spot', 's', 'WITH', 'p.spot = s.id');
//            $qb->join('s.location', 'l', 'WITH', 's.location = l.id');
//            $qb->join('l.region', 'r', 'WITH', 'l.region = r.id');
//            $qb->join('r.country', 'c', 'WITH', 'r.country = ?6');
//            $qb->setParameter(6, $params['country']);
//        }
//




        //species, genus, families, orders, classes, kingdoms
        if (array_key_exists('species', $params)) {
            $qb->andWhere('p.species = ?7');
            $qb->setParameter(7, $params['species']);
        }

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
//            $qb->setParameter(13, $params['genus']);
//        }

        if ($order) {
            $qb->orderBy('p.'.key($order), $order[key($order)]);
        }

        if ($offset) {
            $qb->setFirstResult($offset);
        }
        
       
            $qb->setMaxResults($limit);
       



        return $qb;
    }
    
    
    
}
