<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoContestJudgeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('contest', null, array(
//                'required'=> true,
//                'attr' => array('class' => 'form-control'),
//                'label'=>'form.photo_contest_judge.label.contest'
//                ))
                
            ->add('fosUser', 'autocomplete', array(
                'class' => 'SkaphandrusAppBundle:FosUser',
                'attr' => array('class' => 'form-control m-b'),
                'label'=>'form.photo_contest_judge.label.fosUser'
                ))
                
            ->add('award', 'entity', array(
                'label'=>'form.photo_contest_judge.label.award',
                'class' => 'SkaphandrusAppBundle:SkPhotoContestAward','expanded' => true, 
                'multiple' => true ))
                
            ->add('translations', 'a2lix_translations', array(
                
                'fields' => array(
                    
                    'description' => array(
                        'field_type' => 'textarea',
                        'label' => 'form.photo_contest_judge.label.description', 
                          'attr' => array('class' => 'form-control', 'rows'=>'8'),
          //              'locale_options' => array(
          //                  'fr' => array(
          //                      'label' => 'description'
          //                  ),
          //                  'de' => array(
          //                      'label' => 'Beschreibung'
          //                  ),
          //              )
                          )
            )))   
                
                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoContestJudge'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphotocontestjudge';
    }
}