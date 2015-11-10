<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessDivePriceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('numberofdives', null, array(
//                    'attr' => array('class' => 'form-control'),
//                    'label' => 'form.dive_price.label.number_of_dives'
//                ))
//                ->add('valueperdives', null, array(
//                    'attr' => array('class' => 'form-control'),
//                    'label' => 'form.dive_price.label.value_per_dives'
//                ))

                                ->add('numberofdives')
                ->add('valueperdives')

                
                
                ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessDivePrice'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessdiveprice';
    }

}
