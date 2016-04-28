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
                ->add('name', 'text', array(
                    'label' => false,
                    'help' => 'form.business_fos_user.help.name',
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.business_fos_user.label.name'
                    ))
                )
                ->add('email', 'email', array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.business_fos_user.label.email'
                    ))
                )
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'first_options' => array(
                        'label' => false,
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'form.business_fos_user.label.password'
                        )),
                    'second_options' => array(
                        'label' => false,
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'form.business_fos_user.label.password_confirmation'
                        )),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('businessName', 'text', array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.business_fos_user.label.business_name'
                    ))
                )
//                ->add('location', 'text', array(
//                    'label' => 'form.business_fos_user.label.business',
//                    'attr' => array('class' => 'form-control'))
//                )
                ->add('businessEmail', 'email', array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.business_fos_user.label.business_email'
                    ))
                )
                ->add('observations', 'textarea', array(
                    'label' => false,
                    'required' => false,
//                    'help' => 'form.business_fos_user.help.observations',
                    'attr' => array(
                        'class' => 'form-control',
                        'rows' => 4,
                        'placeholder' => 'form.business_fos_user.label.observations'
                    ))
                )

        ;
    }

    public function getName() {
        return 'skaphandrus_business_user_registration';
    }

}
