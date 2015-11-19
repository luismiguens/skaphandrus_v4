<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FosUserProfileType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('settings', new ProfileSettingsType())
                ->add('personal', new ProfilePersonalType())
                ->add('address', new ProfileAddressType())
                ->add('contact', new ProfileContactType())

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\FosUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_fosuser';
    }

}
