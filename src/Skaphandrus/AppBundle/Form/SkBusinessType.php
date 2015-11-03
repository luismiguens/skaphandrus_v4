<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Intl\Intl;

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
                ->add('foundedAt', null, array(
                    'years' => range(1900, 2030),
                    'label' => 'form.business.label.founded_at'
                ))
            ->add('currency', 'entity', array(
                'label'=>'form.business.label.currency',
                'class' => 'SkaphandrusAppBundle:SkCurrency','expanded' => true, 
                'multiple' => true ))
                
                //->add('currency')
                
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
                ->add('createdAt', null, array(
                    'years' => range(1900, 2030),
                    'label' => 'form.business.label.created_at'
                ))
//                ->add('updatedAt')
                ->add('address', new SkBusinessAddressType())
                ->add('contact', new SkBusinessContactType())
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
