<?php

namespace Skaphandrus\AppBundle\Form;

use Skaphandrus\AppBundle\Form\EventListener\AddCountryFieldSubscriber;
use Skaphandrus\AppBundle\Form\EventListener\AddLocationFieldSubscriber;
use Skaphandrus\AppBundle\Form\EventListener\AddRegionFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SkBusinessFosUserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
                
        $propertyPathToLocation = 'location';
 
        $builder
            ->addEventSubscriber(new AddLocationFieldSubscriber($propertyPathToLocation))
            ->addEventSubscriber(new AddRegionFieldSubscriber($propertyPathToLocation))
            ->addEventSubscriber(new AddCountryFieldSubscriber($propertyPathToLocation))
        ;
        
        
        $builder
                ->add('name', 'text', array('label' => FALSE, 'attr' => array('class' => 'form-control', 'placeholder' => 'form.name')))
                ->add('email', 'email', array('label' => FALSE, 'attr' => array('class' => 'form-control', 'placeholder' => 'form.email')))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'first_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.password', 'class' => 'form-control')),
                    'second_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.password_confirmation', 'class' => 'form-control')),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('business_name', 'text', array('label' => FALSE, 'attr' => array('class' => 'form-control', 'placeholder' => 'form.name')))
                ->add('location', 'text', array('label' => FALSE, 'attr' => array('class' => 'form-control', 'placeholder' => 'form.name')))
                ->add('business_email', 'email', array('label' => FALSE, 'attr' => array('class' => 'form-control', 'placeholder' => 'form.email')))
        ;
    }

//
//    public function getParent()
//    {
//        return 'fos_user_registration';
//    }

    public function getName() {
        return 'skaphandrus_business_user_registration';
    }

}
