<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationSpeciesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('imageRefs', 'collection', array(
                    'type' => new SkIdentificationSpeciesImageRefType(),
                    'allow_add' => TRUE,
                    'prototype' => TRUE,
                    'by_reference' => FALSE,
                    'label' => 'form.identification_species.label.refferences')
                )
//                ->add('criteria', 'collection', array(
//                    'type' => new \Skaphandrus\AppBundle\Form\SkIdentificationCriteriaForSpeciesType(),
//                    'label' => 'form.identification_species.label.refferences')
//                        )
//                ->add('character', 'entity', array(
//                    'class' => 'SkaphandrusAppBundle:SkIdentificationCharacter',
//                    'expanded' => true,
//                    'multiple' => true,
//                    'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
//                        return $er->createQueryBuilder('c')
//                                ->select('c')
//                                //->from('SkIdentificationCharacter', 'c')
//                                ->where('c.criteria in( 1232, 1345)');
//                        //->andWhere('u.is_active = 1');
//                    },
//        ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpecies'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skspecies';
    }

}
