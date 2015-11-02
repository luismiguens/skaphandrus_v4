<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.business.label.name'
                ))
                ->add('foundedAt')
                ->add('currency')
                ->add('about', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.business.label.about'
                ))
                ->add('description', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.business.label.description'
                ))
                ->add('mission', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.business.label.mission'
                ))
                ->add('awards', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.business.label.awards'
                ))
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.business.label.picture',
                    'required' => false,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
                ->add('createdAt')
//            ->add('updatedAt')
                ->add('address', new SkAddressType())   
                ->add('contact', new SkContactType())
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
