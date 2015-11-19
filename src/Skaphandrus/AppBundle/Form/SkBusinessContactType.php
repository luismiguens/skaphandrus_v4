<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessContactType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('email', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.contact.label.email',
                    'help' => 'form.contact.help.email'
                ))
                ->add('fax', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.contact.label.fax',
                    'required' => false
                ))
                ->add('homepage', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.contact.label.homepage',
                    'required' => false
                ))
                ->add('mobilephone', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.contact.label.mobilephone',
                    'required' => false
                ))
                ->add('phone', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.contact.label.phone',
                    'required' => false
                ))
        //->add('shopId')
        //->add('operatorId')
        //->add('accomodationId')
        //->add('createdAt')
        //->add('updatedAt')
        //->add('person')
        //->add('business')
        //->add('fosUser')
        //->add('sponsor')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkContact'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skcontact';
    }

}
