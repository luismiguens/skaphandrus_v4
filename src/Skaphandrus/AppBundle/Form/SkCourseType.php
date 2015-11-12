<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkCourseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.course.label.name',
                    'required' => true,
                ))
//                ->add('createdAt')
//                ->add('updatedAt')
                ->add('affiliation', null, array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.course.label.affiliation',
                    'required' => true,
                ))
                ->add('translations', 'a2lix_translations', array(
                    'required' => true,
                    'fields' => array(
                        'descricao' => array(
                            'attr' => array('class' => 'form-control', 'rows'=>'20'),
                        )
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkCourse'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skcourse';
    }

}
