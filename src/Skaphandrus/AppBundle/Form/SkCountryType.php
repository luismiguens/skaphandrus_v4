<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkCountryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.country.label.name',
                    'required' => true,
                ))
                ->add('fipsCode', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.country.label.fipsCode'
                ))
                ->add('continent', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.country.label.continent',
                    'required' => true
                ))
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'overview' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.overview',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'geographyAndClimate' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.geographyAndClimate',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'entryRequirements' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.entryRequirements',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'healthAndSafety' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.healthAndSafety',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'timeZone' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.timeZone',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'communications' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.communications',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'powerAndElectricity' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.powerAndElectricity',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        ),
                        'otherInformations' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.country.label.otherInformations',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required' => false
                        )
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkCountry'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skcountry';
    }

}
