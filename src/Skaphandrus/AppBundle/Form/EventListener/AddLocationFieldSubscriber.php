<?php

namespace Skaphandrus\AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use Skaphandrus\AppBundle\Entity\SkRegion;
use Skaphandrus\AppBundle\Entity\SkLocation;

class AddLocationFieldSubscriber implements EventSubscriberInterface {

    private $propertyPathToLocation;

    public function __construct($propertyPathToLocation) {
        $this->propertyPathToLocation = $propertyPathToLocation;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    private function addLocationForm($form, $region_id) {
        $formOptions = array(
            'class' => 'SkaphandrusAppBundle:SkLocation',
            'empty_value' => 'form.business_fos_user.label.location',
            'label' => false,
//            'label' => 'form.business_fos_user.label.location',
            'help' => 'form.business_fos_user.help.location',
            'attr' => array(
                'class' => 'form-control',
            ),
            'query_builder' => function (EntityRepository $repository) use ($region_id) {
        $qb = $repository->createQueryBuilder('location')
                ->innerJoin('location.region', 'region')
                ->where('region.id = :region')
                ->setParameter('region', $region_id)
        ;

        return $qb;
    }
        );

        $form->add($this->propertyPathToLocation, 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::createPropertyAccessor();

        $location = $accessor->getValue($data, $this->propertyPathToLocation);
        $region_id = ($location) ? $location->getRegion()->getId() : null;

        $this->addLocationForm($form, $region_id);
    }

    public function preSubmit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        $region_id = array_key_exists('region', $data) ? $data['region'] : null;

        $this->addLocationForm($form, $region_id);
    }

}
