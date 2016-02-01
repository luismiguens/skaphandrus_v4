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
                ->add('settings', new ProfileSettingsType(), array(
                    'required' => false,
                ))
                ->add('personal', new ProfilePersonalType())
                ->add('address', new ProfileAddressType(), array(
                    'required' => false,
                ))
                ->add('contact', new ProfileContactType(), array(
                    'required' => false,
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    // validation for embedded forms 
    // http://stackoverflow.com/questions/10138505/symfony2-validation-not-working-for-embedded-form-type
    //
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'cascade_validation' => true,
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
