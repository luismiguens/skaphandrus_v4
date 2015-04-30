<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',array('attr' => array('class'=>'form-control')))
            ->add('file', 'file',array('attr' => array('class'=>'')))
            ->add('description','textarea',array('attr' => array('class'=>'form-control')))
            //->add('views')
            //->add('takenAt', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
            //->add('createdAt')
            ->add('creative','entity',array('class' => 'SkaphandrusAppBundle:SkCreativeCommons','attr' => array('class'=>'form-control m-b')))
            //->add('creative')
            ->add('model', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkPhotoMachineModel'))
            //->add('spot')
            //->add('species')
            ->add('fosUser')
            //->add('keyword')
            //->add('category')
                    ->add('saveAndAdd', 'submit', array('label' => 'Save and Add'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhoto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphoto';
    }
}
