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

        $entity = $builder->getData();

        //http://stackoverflow.com/questions/7698524/how-to-work-with-entity-form-field-type-and-jui-autocomplete-in-symfony2
        //para funcionar com multiple select choices
        $spotChoices = array();
        $spotChoicesChecked = array();
        
        if ($this->business && $this->business->getSpot()) {
            foreach ($this->business->getSpot() as $spot) {
                $spotChoices[$spot->getId()] = $spot->getName();
                $spotChoicesChecked[] = $spot->getId();
            }
        }


        //dump($spotChoices);

        $builder
                ->add('spotChoices', 'choice', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => $spotChoices,
                    'mapped' => false,
                    'data'=>$spotChoicesChecked
                ))
                ->add('spotAutocomplete', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkSpot',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.photo.label.spot',
                    'required' => false,
                    //'help' => 'form.photo.help.spot',
                    'mapped' => false,
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
                    'label' => 'form.business.label.rent_equipment'
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

    //necessário adicionart para multiple checkbox select
    public function __construct(\Skaphandrus\AppBundle\Entity\SkBusiness $business) {
        $this->business = $business;
        //$this->em = $em;
    }

}
