<?php

namespace Skaphandrus\AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use Skaphandrus\AppBundle\Entity\SkCountry;

class AddRegionFieldSubscriber implements EventSubscriberInterface {

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

    private function addRegionForm($form, $country_id, $region = null) {
        $formOptions = array(
            'class' => 'SkaphandrusAppBundle:SkRegion',
            'empty_value' => 'form.business_fos_user.label.region',
            'label' => false,
//            'label' => 'form.business_fos_user.label.region',
            'mapped' => false,
            'attr' => array(
                'class' => 'form-control'
            ),
            'query_builder' => function (EntityRepository $repository) use ($country_id) {
        $qb = $repository->createQueryBuilder('region')
                ->innerJoin('region.country', 'country')
                ->where('country.id = :country')
                ->setParameter('country', $country_id)
        ;

        return $qb;
    }
        );

        if ($region) {
            $formOptions['data'] = $region;
        }

        $form->add('region', 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::getPropertyAccessor();

        $location = $accessor->getValue($data, $this->propertyPathToLocation);
        $region = ($location) ? $location->getRegion() : null;
        $country_id = ($region) ? $region->getCountry()->getId() : null;

        $this->addRegionForm($form, $country_id, $region);
    }

    public function preSubmit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        $country_id = array_key_exists('country', $data) ? $data['country'] : null;

        $this->addRegionForm($form, $country_id);
    }

}
