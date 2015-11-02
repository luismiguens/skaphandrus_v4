<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkAddressType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('postcode')
                ->add('province')
                ->add('street')
                //->add('shopId')
                //->add('personId')
                //->add('createdAt')
                //->add('updatedAt')
                ->add('location', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkLocation',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.address.label.location',
                    'required' => false
                ))
                ->add('coordinate', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.coordinate',
                    'required' => false
                ))
                ->add('zoom', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.address.label.zoom',
                    'required' => false
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
