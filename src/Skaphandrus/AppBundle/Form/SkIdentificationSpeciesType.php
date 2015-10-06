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
        
//                $builder->addEventListener(\Symfony\Component\Form\FormEvents::PRE_SET_DATA, function (\Symfony\Component\Form\FormEvent $event) {
//            $criteria = $event->getData();
//            dump($criteria);
//
//            $form = $event->getForm();
        
        //dump($options);
//        $criterias = $options[0];
        
       //dump($criterias);
        
       // $criterias = null;
        
        $builder
                ->add('imageRefs', 'collection', array(
                    'type' => new SkIdentificationSpeciesImageRefType(),
                    'allow_add' => TRUE,
                    'prototype' => TRUE,
                    'by_reference' => FALSE,
                    'label' => 'form.identification_species.label.refferences')
                )
                
                
                ->add('character', 'entity', array(
                'class' => 'SkaphandrusAppBundle:SkIdentificationCharacter',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('c')
                                    ->select('c')
                                    ->where('c.criteria IN(:criterias)')
                                    ->setParameter('criterias', array_values($options['criterias']));
                }
            ));
                
                
//                ->add('criterias', 'collection', array(
//                    'type' => new \Skaphandrus\AppBundle\Form\SkIdentificationCriteriaForSpeciesType(),
//                    'label' => 'form.identification_species.label.refferences')
//                        )

//                });
    
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpecies',
            'criterias' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skspecies';
    }

}
