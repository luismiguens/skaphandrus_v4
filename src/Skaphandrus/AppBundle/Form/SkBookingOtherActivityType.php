<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBookingOtherActivityType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pax', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_other_activity.label.pax'
                ))
                ->add('dateAt', null, array(
                    'years' => range(2016, 2030),
                    'label' => 'form.booking_other_activity.label.date_at'
                ))
                ->add('schedule', 'choice', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking.label.certificationLevel',
                    'choices' => array(
                        '0' => 'form.booking_other_activity.label.schedule_morning',
                        '1' => 'form.booking_other_activity.label.schedule_afternoon',
                        '2' => 'form.booking_other_activity.label.schedule_night',
                    )
                ))
                ->add('otherActivity', null, array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking_other_activity.label.other_activity',
                    'required' => true
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBookingOtherActivity'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbookingotheractivity';
    }

}
