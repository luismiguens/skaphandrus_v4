<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessUnitType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('temperature', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.temperature',
                    'class' => 'SkaphandrusAppBundle:SkUnitTemperature',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('volume', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.volume',
                    'class' => 'SkaphandrusAppBundle:SkUnitVolume',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('weight', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.weight',
                    'class' => 'SkaphandrusAppBundle:SkUnitWeight',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('pressure', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.pressure',
                    'class' => 'SkaphandrusAppBundle:SkUnitPressure',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('length', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.length',
                    'class' => 'SkaphandrusAppBundle:SkUnitLength',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
//                ->add('business')
                ->add('capacity', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.capacity',
                    'class' => 'SkaphandrusAppBundle:SkUnitCapacity',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('currency', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.currency',
                    'class' => 'SkaphandrusAppBundle:SkUnitCurrency',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
                ->add('velocity', 'entity', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.unit.label.velocity',
                    'class' => 'SkaphandrusAppBundle:SkUnitVelocity',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessUnit'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessunit';
    }

}
