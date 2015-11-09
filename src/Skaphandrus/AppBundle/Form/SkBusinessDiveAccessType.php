<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessDiveAccessType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('daydiveboat')
                ->add('shoredive')
                ->add('nightdive')
                ->add('housereef')
                ->add('daytours')
                ->add('halfdaytours')
                ->add('unguideddives')
                ->add('perdaydives')
                ->add('maxdepthdives')
                ->add('maxminutesdives')
                ->add('maxpersonsperdive')
                ->add('observations')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessdiveaccess';
    }

}
