<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileAddressType extends AbstractType {

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
                //->add('coordinate')
                //->add('zoom')
                //->add('accomodationId')
                //->add('operatorId')
                //->add('fosUser')
                ->add('location', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkLocation',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.address.label.location',
                    'required' => false
                ))
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
