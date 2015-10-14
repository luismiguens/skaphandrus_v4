<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoContestAwardType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', 'vich_image', array(
                'label'=>'form.photo_contest_award.label.image_file',
                'required'      => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
                ))
                
//            ->add('winnerPhoto', null, array(
//                'attr' => array('class' => 'form-control'),
//                'label'=>'form.photo_contest_award.label.winner_photo'
//                ))
                
            ->add('contest', null, array(
                'required'=> true,
                'attr' => array('class' => 'form-control'),
                'label'=>'form.photo_contest_award.label.contest'
                ))
          
            ->add('winnerFosUser', 'autocomplete', array(
                'required'=> false,
                'class' => 'SkaphandrusAppBundle:FosUser',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.photo_contest_award.label.winnerFosUser', 
                ))
               
            ->add('category', null, array(
                'attr' => array('class' => 'form-control'),
                'label'=>'form.photo_contest_award.label.category'  ,
'property' => 'CategoryJoinContestString',                ))
                
//            ->add('judge', 'entity', array(
//                'label'=>'form.photo_contest_award.label.judge',
//                'class' => 'SkaphandrusAppBundle:SkPhotoContestJudge','expanded' => true, 
//                'multiple' => true ))
                
            ->add('sponsor', 'entity', array(
                'label'=>'form.photo_contest_award.label.sponsor',
                'class' => 'SkaphandrusAppBundle:SkPhotoContestSponsor',
                'expanded' => true, 
                'multiple' => true 
                ))
                
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'description' => array(
                        'field_type' => 'textarea',
                        'label' => 'form.photo_contest_award.label.description', 
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
                    'name' => array(
                        'field_type' => 'text',
                        'label' => 'form.photo_contest_award.label.name',
                        'attr' => array('class' => 'form-control',  'rows'=>'40'),
        //                  'locale_options' => array(
        //                    'en' => array(
        //                        'label' => 'nom'
        //                    ),
        //                    'de' => array(
        //                      'label' => 'Name'
        //                  ),
        //                )
                        ),
            )))
                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoContestAward'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphotocontestaward';
    }
}
