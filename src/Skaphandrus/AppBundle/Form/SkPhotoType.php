<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array('attr' => array('class' => 'form-control')))
                ->add('file', 'file', array('attr' => array('class' => '')))
                ->add('description', 'textarea', array('attr' => array('class' => 'form-control')))
                //->add('views')
                //->add('takenAt', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
                //->add('createdAt')
                ->add('creative', 'entity', array('class' => 'SkaphandrusAppBundle:SkCreativeCommons', 'attr' => array('class' => 'form-control m-b')))
                ->add('model', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkPhotoMachineModel'))
                ->add('spot', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkSpot'))
                ->add('species', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkSpecies'))
                ->add('fosUser')
                //->add('keyword')
                //->add('category')
                ->add('cancel', 'submit', array('label' => 'Cancel','attr' => array('class' => 'btn btn-white')))
                ->add('submit', 'submit', array('label' => 'Save','attr' => array('class' => 'btn btn-primary')))
                

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhoto'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skphoto';
    }

}
