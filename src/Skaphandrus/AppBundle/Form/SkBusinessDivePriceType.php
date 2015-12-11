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
                ->add('numberofdives', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_price.label.number_of_dives',
                    'required' => false,
                ))
                ->add('valueperdives', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_price.label.value_per_dives',
                    'required' => false,
                    'help' => array('help' => 'form.dive_price.help.value_per_dives', 'param' => $options['my_custom_option'])
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'my_custom_option' => false,
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
