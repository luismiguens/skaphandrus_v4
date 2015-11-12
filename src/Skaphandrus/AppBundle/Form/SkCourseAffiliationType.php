<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkCourseAffiliationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('sigla', null, array(
                    'required' => true,
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.course_affiliation.label.sigla'
                ))
                ->add('website', null, array(
                    'required' => true,
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.course_affiliation.label.website'
                ))
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.course_affiliation.label.image_file',
                    'required' => false,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkCourseAffiliation'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skcourseaffiliation';
    }

}
