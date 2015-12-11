<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessEducationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $entity = new \Skaphandrus\AppBundle\Entity\SkBusiness();
        $entity = $builder->getData();

        $builder
                ->add('educationCourse', 'collection', array(
                    'type' => new SkBusinessEducationCourseType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.business.label.education_course',
                    'options' => array('my_custom_option' => $entity->getUnit()->getCurrency())
                ))
                ->add('educationConditions', new SkBusinessEducationConditionsType(), array(
                    'label' => 'form.business.label.education_conditions',
                    'required' => false,
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
