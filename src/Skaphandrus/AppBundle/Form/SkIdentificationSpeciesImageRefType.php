<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationSpeciesImageRefType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('imageUrl', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'image.url',
                    'required' => false
                ))
                ->add('imageSrc', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'image.src',
                    'required' => false
                ))
                ->add('photographer', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.identification_species.label.photographer',
                    'required' => false
                ))
                ->add('license', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.identification_species.label.license',
                    'required' => false
                ))
                ->add('isPrimary', 'checkbox', array(
                    'label' => 'form.identification_species.label.primary',
                    'required' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpeciesImageRef'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skspeciesimageref';
    }

}
