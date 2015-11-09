<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessSafetyType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('oxigen', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.safety.label.oxigen'
                ))
                ->add('firstaidkit', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.safety.label.first_aid_kit'
                ))
                ->add('hourstohospital', null, array(
                    'label' => 'form.safety.label.hours_to_hospital'
                ))
                ->add('hourstodecochamber', null, array(
                    'label' => 'form.safety.label.hours_to_decochamber'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessSafety'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinesssafety';
    }

}
