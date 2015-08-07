<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoContestCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translations', array(
                
                'fields' => array(
                    
                    'name' => array(
                        'field_type' => 'text',
                        'label' => 'form.photo_contest_category.label.name',
                        'attr' => array('class' => 'form-control'),
        //                  'locale_options' => array(
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
                        'label' => 'form.photo_contest_category.label.description', 
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
            )))
                
            ->add('image', null, array(
                'attr' => array('class' => 'form-control'),
                'label'=>'form.photo_contest_category.label.image'
                ))
                
            ->add('contest', null, array(
                'required'=> true,
                'attr' => array('class' => 'form-control'),
                'label'=>'form.photo_contest_category.label.contest'
                ))
                
//            ->add('photo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoContestCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphotocontestcategory';
    }
}
