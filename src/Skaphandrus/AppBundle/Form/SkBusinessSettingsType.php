<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessSettingsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        //http://stackoverflow.com/questions/7698524/how-to-work-with-entity-form-field-type-and-jui-autocomplete-in-symfony2
        //para funcionar com multiple select choices
        $adminChoices = array();
        $adminChoicesChecked = array();

        if ($this->business && $this->business->getAdmin()) {
            foreach ($this->business->getAdmin() as $admin) {
                $adminChoices[$admin->getId()] = $admin->getName();
                $adminChoicesChecked[] = $admin->getId();
            }
        }

        $builder
                ->add('adminAutocomplete', 'autocomplete', array(
                    'label' => 'form.business.label.admin_autocomplete',
                    'class' => 'SkaphandrusAppBundle:FosUser',
                    'attr' => array('class' => 'form-control m-b'),
                    'required' => false,
                    'help' => 'form.business.help.admin',
                    'mapped' => false,
                ))
                ->add('adminChoices', 'choice', array(
                    'label' => 'form.business.label.admin_choices',
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => $adminChoices,
                    'mapped' => false,
                    'data' => $adminChoicesChecked
                ))
                ->add('unit', new SkBusinessUnitType(), array(
                    'label' => 'form.business.label.unit',
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
