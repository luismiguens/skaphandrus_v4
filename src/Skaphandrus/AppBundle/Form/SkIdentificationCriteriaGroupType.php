<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationCriteriaGroupType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) { 
        $builder
//            ->add('criteria')
            ->add('group')
//            ->add('criteria', new SkIdentificationCriteriaType(), array(
//                    'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationCriteria'))
//            ->add('group', new SkIdentificationGroupType(), array(
//                    'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationGroup'))
            ->add('specie', 'collection', array('type' => new SkSpeciesType()))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationCriteriaGroup',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skidentificationcriteriagroup';
    }

}
