<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessRentEquipmentType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('equipmenttype', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.rent_equipment.label.equipment_type',
                    'required' => false,
                ))
                ->add('quantity', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.rent_equipment.label.quantity',
                    'required' => false,
                    'help' => 'form.rent_equipment.help.quantity'
                ))
                ->add('rentvalue', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.rent_equipment.label.rent_value',
                    'required' => false,
                    'help' => array('help' => 'form.rent_equipment.help.rent_value', 'param' => $options['my_custom_option'])
                ))
//                ->add('businessboat')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'my_custom_option' => false,
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessRentEquipment'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessrentequipment';
    }

}
