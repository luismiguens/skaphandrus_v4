<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkRegionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('country', 'entity', array(
                    'class' => 'SkaphandrusAppBundle:SkCountry',
                    'query_builder' => function (\Skaphandrus\AppBundle\Entity\Repository\SkCountryRepository $er) {
                        return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                    },
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.region.label.country'
                ))
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'name' => array(
                            'field_type' => 'text',
                            'label' => 'form.region.label.name',
                            'attr' => array('class' => 'form-control'),
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
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkRegion'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skregion';
    }

}
