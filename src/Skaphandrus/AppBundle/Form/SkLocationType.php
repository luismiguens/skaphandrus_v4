<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkLocationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('region', 'entity', array(
                    'class' => 'SkaphandrusAppBundle:SkRegion',
                    'query_builder' => function (\Skaphandrus\AppBundle\Entity\Repository\SkRegionRepository $er) {
                        return $er->createQueryBuilder('r')->orderBy('r.country', 'ASC');
                    },
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.location.label.region'
                ))                
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'name' => array(
                            'field_type' => 'text',
                            'label' => 'form.spot.label.name',
                            'attr' => array('class' => 'form-control'),
                        ),
                        'description' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.description',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                        ),
                        'waterTemp' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.waterTemp',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                        'suit' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.suit',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                        'visibility' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.visibility',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                        'climate' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.climate',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                        'howToGo' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.howToGo',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                        'extraDive' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.spot.label.extraDive',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                            'required'=>false
                        ),
                    )
                
                )
               ) 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkLocation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_sklocation';
    }
}
