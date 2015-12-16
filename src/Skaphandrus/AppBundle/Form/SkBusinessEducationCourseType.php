<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessEducationCourseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('course', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.education_course.label.course',
                    'required' => false,
                ))
                ->add('price', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 0),
                    'label' => 'form.education_course.label.price',
                    'required' => false,
                    'help' => array('help' => 'form.education_course.help.price', 'param' => $options['my_custom_option'])
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
            'my_custom_option' => false,
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessEducationCourse'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinesseducationcourse';
    }

}
