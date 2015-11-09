<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessGasType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('atmosphericair', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.gas.label.atmospheric_air'
                ))
                ->add('nitrox', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.gas.label.nitrox'
                ))
                ->add('trimix', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.gas.label.trimix'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessGas'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessgas';
    }

}
