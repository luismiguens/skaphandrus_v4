<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationGroupType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('module')
            ->add('genus', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkGenus',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.identification_group.label.genus', 
                'required' => false
            ))
            ->add('family', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkFamily',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.identification_group.label.family', 
                'required' => false
            ))
            ->add('order', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkOrder',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.identification_group.label.order', 
                'required' => false
            ))
            ->add('class', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkClass',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.identification_group.label.class', 
                'required' => false
            ))
            ->add('phylum', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkPhylum',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.identification_group.label.phylum', 
                'required' => false
            ))
            ->add('isParentModule')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationGroup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skidentificationgroup';
    }
}
