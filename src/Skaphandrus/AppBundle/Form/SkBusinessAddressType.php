<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessAddressType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('postcode', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.postcode',
                    'required' => false
                ))
                ->add('province', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.province',
                    'required' => false
                ))
                ->add('street', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.street',
                    'required' => false
                ))
                //->add('shopId')
                //->add('personId')
                //->add('createdAt')
                //->add('updatedAt')
                ->add('location', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkLocation',
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.location',
                    'help' => 'form.address.help.location'
                ))
                ->add('coordinate', 'text', array(
                    'attr' => array('class' => 'form-control', 'readonly' => true),
                    'label' => 'form.address.label.coordinate',
                    'required' => false,
                    'help' => 'form.address.help.coordinate'
                ))
                ->add('zoom', 'text', array(
                    'attr' => array('class' => 'form-control', 'readonly' => true),
                    'label' => 'form.address.label.zoom',
                    'required' => false,
                    'help' => 'form.address.help.zoom'
                ))
        //->add('accomodationId')
        //->add('operatorId')
        //->add('fosUser')
        //->add('business')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skaddress';
    }

}
