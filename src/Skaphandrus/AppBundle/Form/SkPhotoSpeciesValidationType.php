<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoSpeciesValidationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('species', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkSpecies',
                'attr' => array('class' => 'form-control'),
                'label' => 'form.photo_validation.label.species', 
                'required' => true
            ))
            ->add('rating', 'choice', array(
                'label' => 'form.photo_validation.label.rating',
                'choices'  => array(1 => '1 ' , 2 => '2 ', 3 => '3 ', 4 => '4 ', 5 => '5 '),
                'required' => true,
                'expanded' => true,
                'multiple' => false,
            ))
            //->add('photo')
            ->add('submit', 'submit', array(
                'label' => 'form.common.btn.save',
                'attr' => array(
                    'class' => 'btn btn-primary'
                ),
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoSpeciesValidation'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skphotovalidation';
    }

}
