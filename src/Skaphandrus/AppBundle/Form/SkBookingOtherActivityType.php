<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Skaphandrus\AppBundle\Entity\Repository\SkOtherActivityRepository;

class SkBookingOtherActivityType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $business_id = $options['business_id'];
        
        $builder
                ->add('otherActivity', null, array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking_other_activity.label.other_activity',
                    'class' => 'SkaphandrusAppBundle:SkOtherActivity',
                    'query_builder' => function (SkOtherActivityRepository $er) use($business_id) {
                        return $er->createQueryBuilder('o')
                                ->join('o.business', 'b')
                                ->orWhere('b.id = ?1')
                                ->setParameter(1, $business_id);
                    },
                    'required' => true
                ))
                ->add('schedule', 'choice', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking_other_activity.label.schedule',
                    'choices' => array(
                        '0' => 'form.booking_other_activity.label.schedule_morning',
                        '1' => 'form.booking_other_activity.label.schedule_afternoon',
                        '2' => 'form.booking_other_activity.label.schedule_night',
                    )
                ))
                ->add('pax', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_other_activity.label.pax'
                ))
                ->add('dateAt', null, array(
                    'years' => range(2016, 2030),
                    'label' => 'form.booking_other_activity.label.date_at'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBookingOtherActivity',
            'business_id' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbookingotheractivity';
    }

}
