<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoContestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.name'
                ))

//            ->add('logo')
                ->add('logoTipo', 'vich_image', array(
                    'label' => 'form.photo_contest.label.logo',
                    'required' => false,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))

//            ->add('image')
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.photo_contest.label.image_file',
                    'required' => false,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
                ->add('beginAt', null, array(
                    'years' => range(2010, 2030),
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.begin_at'
                ))
                ->add('endAt', null, array(
                    'years' => range(2010, 2030),
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.end_at'
                ))
                ->add('winnerAt', null, array(
                    'years' => range(2010, 2030),
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.winner_at'
                ))
                ->add('isJudge', null, array(
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.is_judge'
                ))
                ->add('isVisible', 'checkbox', array(
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.is_visible',
                    'required' => false,
                ))
                ->add('createdAt', null, array(
                    'years' => range(2010, 2030),
//                'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.created_at'
                ))
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'description' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.photo_contest.label.description',
                            'attr' => array('class' => 'form-control', 'rows' => '8'),
                        //              'locale_options' => array(
                        //                  'fr' => array(
                        //                      'label' => 'description'
                        //                  ),
                        //                  'de' => array(
                        //                      'label' => 'Beschreibung'
                        //                  ),
                        //              )
                        ),
                        'rules' => array(
                            'field_type' => 'textarea',
                            'label' => 'form.photo_contest.label.rules',
                            'attr' => array('class' => 'form-control', 'rows' => '40'),
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
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhotoContest'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skphotocontest';
    }

}
