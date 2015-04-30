<?php
namespace Skaphandrus\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkPhotoMachineModel
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */
class SkPhotoMachineModelRepository extends EntityRepository{
    //put your code here
    public function findLikeName($term) {
//        return $this->getEntityManager()
//      ->createQuery(
//        "SELECT m 
//        FROM SkaphandrusAppBundle:SkPhotoMachineModel m
//        WHERE m.name like :term
//        ORDER BY m.name DESC"
//      )->setParameter('term', $term)->getResult();
        
        
        return $this->getEntityManager()->getRepository('SkaphandrusAppBundle:SkPhotoMachineModel')->findAll();
        
  }
}


