<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBookingDiveType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pax', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_dive.label.pax',
                    'data' => 1
                ))
                ->add('numberDives', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_dive.label.number_dives',
                    'data' => 1
                ))
                ->add('dateAt', null, array(
                    'years' => range(2016, 2030),
                    'label' => 'form.booking_dive.label.date_at'
                ))
//                ->add('booking')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBookingDive'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbookingdive';
    }

}
