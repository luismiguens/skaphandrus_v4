<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessEducationConditionsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('swimmingpool', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.education_conditions.label.swimming_pool',
                    'required' => false,
                ))
                ->add('separateclassroom', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.education_conditions.label.separate_classroom',
                    'required' => false,
                    'help' => 'form.education_conditions.help.separate_classroom'
                ))
                ->add('singleeducation', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.education_conditions.label.single_education',
                    'required' => false,
                ))
                ->add('maxgroupsize', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.education_conditions.label.max_group_size',
                    'required' => false,
                ))
                ->add('observations', null, array(
                    'attr' => array('class' => 'form-control', 'rows' => 15),
                    'label' => 'form.education_conditions.label.observations',
                    'required' => false,
                ))
//                ->add('createdAt')
//                ->add('updatedAt')
//                ->add('business')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessEducationConditions'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinesseducationconditions';
    }

}
