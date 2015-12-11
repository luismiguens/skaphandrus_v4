<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessSpotType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $entity = new \Skaphandrus\AppBundle\Entity\SkBusiness();
        $entity = $builder->getData();

        //dump($entity);

        $builder
                ->add('spot', 'collection', array(
                    'type' => new SkBusinessDiveSpotType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.business.label.dive_spot'
                ))
                ->add('divePrice', 'collection', array(
                    'type' => new SkBusinessDivePriceType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.business.label.dive_price',
                    'options' => array('my_custom_option' => $entity->getUnit()->getCurrency())
                ))
                ->add('rentEquipment', 'collection', array(
                    'type' => new SkBusinessRentEquipmentType(),
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label' => 'form.business.label.rent_equipment',
                    'options' => array('my_custom_option' => $entity->getUnit()->getCurrency())
                ))
                ->add('diveAccess', new SkBusinessDiveAccessType(), array(
                    'label' => 'form.business.label.dive_access',
                    'required' => false,
                ))
                ->add('gas', new SkBusinessGasType(), array(
                    'label' => 'form.business.label.gas',
                    'required' => false,
                ))
                ->add('safety', new SkBusinessSafetyType(), array(
                    'label' => 'form.business.label.safety',
                    'required' => false,
                ))
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
