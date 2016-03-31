<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkContestRequestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array(
                    'attr' => array('class' => 'form-control', 'placeholder' => 'form.contest_request.placeholder.name'),
                    'label' => false
                ))
                ->add('email', null, array(
                    'attr' => array('class' => 'form-control', 'placeholder' => 'form.contest_request.placeholder.email'),
                    'label' => false
                ))
                ->add('phone', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1, 'placeholder' => 'form.contest_request.placeholder.phone'),
                    'label' => false
                ))
                ->add('description', 'textarea', array(
                    'attr' => array('class' => 'form-control','rows' => '2', 'placeholder' => 'form.contest_request.placeholder.description'),
                    'label' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkContestRequest'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skcontestrequest';
    }

}
