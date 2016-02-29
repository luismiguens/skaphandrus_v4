<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBookingType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('business', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkBusiness',
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.booking.label.business',
                    'help' => 'form.booking.help.business'
                ))
//                ->add('business_id', 'hidden')
                ->add('beginAt', null, array(
                    'years' => range(2016, 2030),
                    'label' => 'form.booking.label.begin_at'
                ))
                ->add('endAt', null, array(
                    'years' => range(2016, 2030),
                    'label' => 'form.booking.label.end_at'
                ))
                ->add('certificationLevel', 'choice', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking.label.certification_level',
                    'choices' => array(
                        '0' => 'form.booking.label.certification_level_basic',
                        '1' => 'form.booking.label.certification_level_intermediate',
                        '2' => 'form.booking.label.certification_level_advanced',
                    )
                ))
                //(Hour of arrival, extra services, activities...)
                ->add('observations', 'textarea', array(
                    'label' => 'form.booking.label.observations',
                    'attr' => array('class' => 'form-control',
                        'rows' => 8,
                        'placeholder' => 'form.booking.label.observations_placeholder'
                    ),
                    'required' => false
                ))
                ->add('phoneNumber', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.booking.label.phone_number',
                    'required' => false
                ))
                ->add('email', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.booking.label.email'
                ))
//                ->add('bookingDive', new SkBookingDiveType(), array(
//                    'label' => 'form.booking.label.booking_dive'
//                ))
                ->add('bookingDive', 'collection', array(
                    'type' => new SkBookingDiveType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.booking.label.booking_dive'
                ))
                ->add('bookingOtherActivity', 'collection', array(
                    'type' => new SkBookingOtherActivityType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.booking.label.booking_other_activity'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBooking'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbooking';
    }

}
