<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessDiveSpotType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkSpot',
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_spot.label.name',
                    'help' => 'form.dive_spot.help.name'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusiness'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusiness';
    }

}
