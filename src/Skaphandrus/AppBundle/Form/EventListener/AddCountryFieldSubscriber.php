<?php

namespace Skaphandrus\AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddCountryFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToLocation;

    public function __construct($propertyPathToLocation)
    {
        $this->propertyPathToLocation = $propertyPathToLocation;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }

    private function addCountryForm($form, $country = null)
    {
        $formOptions = array(
            'class'         => 'SkaphandrusAppBundle:SkCountry',
            'mapped'        => false,
            'label'         => 'Country',
            'empty_value'   => 'Country',
            'attr'          => array(
                'class' => 'country_selector',
            ),
        );

        if ($country) {
            $formOptions['data'] = $country;
        }

        $form->add('country', 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::getPropertyAccessor();

        $location    = $accessor->getValue($data, $this->propertyPathToLocation);
        $country = ($location) ? $location->getRegion()->getCountry() : null;

        $this->addCountryForm($form, $country);
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();

        $this->addCountryForm($form);
    }
}