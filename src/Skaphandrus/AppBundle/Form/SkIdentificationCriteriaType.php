<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationCriteriaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'name' => array(
                        'attr' => array('class' => 'form-control'),
                    )
                )
            ))
            ->add('orderBy', 'text', array('attr' => array('class' => 'form-control')))
            ->add('isCumulative')
            ->add('type')
            ->add('groups')
            ->add('characters', 'collection', array(
                'type' => new SkIdentificationCharacterType(),
                'allow_add' => TRUE,
                'prototype' => TRUE,
                'by_reference' => FALSE,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationCriteria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skidentificationcriteria';
    }
}
