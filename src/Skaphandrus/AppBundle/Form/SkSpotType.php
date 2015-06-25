<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkSpotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxDepth', 'integer', 
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.spot.label.maxDepth'
                            ))
            ->add('coordinate','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.spot.label.coordinate'
                            ))
            ->add('zoom', 'text', 
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.spot.label.zoom'
                            ))
            //->add('isAproved')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('fosUser')
                            ->add('location', 'autocomplete', 
                        array(
                            'class' => 'SkaphandrusAppBundle:SkLocation',
                            'attr' => array('class' => 'form-control m-b'),
                            'label'=>'form.spot.label.location', 
                            'required' => false
                            )
                        )
                 ->add('translations', 'a2lix_translations', array(

        'fields' => array(
            'name' => array(
                'field_type' => 'text',
                'label' => 'form.spot.label.name',
                'attr' => array('class' => 'form-control'),
//                'locale_options' => array(
//                    'en' => array(
//                        'label' => 'nom'
//                    ),
//                    'de' => array(
//                      'label' => 'Name'
//                  ),
//                )
                ),
            'description' => array(
              'field_type' => 'textarea',
              'label' => 'form.spot.label.description', 
                'attr' => array('class' => 'form-control', 'rows'=>'8'),
//              'locale_options' => array(
//                  'fr' => array(
//                      'label' => 'description'
//                  ),
//                  'de' => array(
//                      'label' => 'Beschreibung'
//                  ),
//              )
                ),
            ))); 
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpot'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skspot';
    }
}
