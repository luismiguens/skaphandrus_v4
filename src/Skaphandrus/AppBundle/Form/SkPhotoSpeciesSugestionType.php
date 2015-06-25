<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoSpeciesSugestionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('species', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:SkSpecies',
                'attr' => array('class' => 'form-control'),
                'label' => 'form.photo_sugestion.label.species', 
                'required' => true
            ))
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
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoSpeciesSugestion'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skphotosugestion';
    }

}
