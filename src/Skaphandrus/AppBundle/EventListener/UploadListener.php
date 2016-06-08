<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Skaphandrus\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Skaphandrus\AppBundle\Entity\SkPhoto;
use Symfony\Component\Security\Core\SecurityContextInterface;

class UploadListener {

    protected $manager;
    protected $security;

    public function __construct(EntityManager $manager, SecurityContextInterface $security) {
        $this->manager = $manager;
        $this->security = $security;
    }

    public function onUpload(PostPersistEvent $event) {

        $user = $this->security->getToken()->getUser();
        $file = $event->getFile();

        $object = new SkPhoto();
        $object->setTitle($file->getFileName());
        $object->setImage($file->getFileName());
        $object->setFosUser($user);

        $this->manager->persist($object);
        $this->manager->flush();
    }

}
