<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoContestSponsorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', 'vich_image', array(
                'label'=>'form.photo_contest_sponsor.label.image_file',
                'required'      => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
                ))
                
            ->add('name', null, array(
                'attr' => array('class' => 'form-control'),
                'label'=>'form.photo_contest_sponsor.label.name'
                ))
                
            ->add('translations', 'a2lix_translations', array(
                
                'fields' => array(
                    
                    'description' => array(
                        'field_type' => 'textarea',
                        'label' => 'form.photo_contest_sponsor.label.description', 
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
//            ->add('contest', null, array(
//                'required'=> true,
//                'attr' => array('class' => 'form-control'),
//                'label'=>'form.photo_contest_sponsor.label.contest'
//                ))
                
//            ->add('award')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoContestSponsor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphotocontestsponsor';
    }
}
