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
                ->add('title', 'text', array('attr' => array('class' => 'form-control'),'label'=>'form.photo.label.title' ) )
                ->add('file', 'file', array('label'=>'form.photo.label.file'))
                ->add('description', 'textarea', array('attr' => array('class' => 'form-control'),'label'=>'form.photo.label.description'))
                //->add('views')
                //->add('takenAt', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
                //->add('createdAt')
                ->add('creative', 'entity', array('class' => 'SkaphandrusAppBundle:SkCreativeCommons', 'attr' => array('class' => 'form-control'),'label'=>'form.photo.label.creative'))
                ->add('model', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkPhotoMachineModel','attr' => array('class' => ''),'label'=>'form.photo.label.model'))
                ->add('spot', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkSpot','attr' => array('class' => 'form-control m-b'),'label'=>'form.photo.label.spot'))
                ->add('species', 'autocomplete', array('class' => 'SkaphandrusAppBundle:SkSpecies','attr' => array('class' => 'form-control m-b'),'label'=>'form.photo.label.species'))
                ->add('fosUser')
                //->add('keyword')
                //->add('category')
                //->add('cancel', 'submit', array('label' => 'form.common.btn.cancel','attr' => array('class' => 'btn btn-primary')))
                //->add('submit', 'submit', array('label' => 'form.common.btn.save','attr' => array('class' => 'btn btn-primary')))
                

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
