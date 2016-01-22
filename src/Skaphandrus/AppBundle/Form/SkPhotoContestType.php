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

        $entity = $builder->getData();
        $required = true;

        //se estiver no edit, imagem nao é obrigatoria
        if ($entity->getId()):
            $required = false;
        endif;

        $builder
                ->add('name', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo_contest.label.name',
                    'required' => true
                ))
                ->add('logoTipo', 'vich_image', array(
                    'label' => 'form.photo_contest.label.logo',
                    'help' => 'form.photo_contest.help.logoTipo',
                    'required' => $required,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.photo_contest.label.image_file',
                    'help' => 'form.photo_contest.help.imageFile',
                    'required' => $required,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
                ->add('promoAt', null, array(
                    'years' => range(2010, 2030),
                    'label' => 'form.photo_contest.label.promo_at',
                    'help' => 'form.photo_contest.help.promoAt'
                ))
                ->add('beginAt', null, array(
                    'years' => range(2010, 2030),
                    'label' => 'form.photo_contest.label.begin_at',
                    'help' => 'form.photo_contest.help.beginAt'
                ))
                ->add('publicVotationAt', null, array(
                    'years' => range(2010, 2030),
                    'label' => 'form.photo_contest.label.public_votation_at',
                    'help' => 'form.photo_contest.help.publicVotationAt'
                ))
                ->add('endAt', null, array(
                    'years' => range(2010, 2030),
                    'label' => 'form.photo_contest.label.end_at',
                    'help' => 'form.photo_contest.help.endAt'
                ))
                ->add('winnersAt', null, array(
                    'years' => range(2010, 2030),
                    'label' => 'form.photo_contest.label.winner_at',
                    'help' => 'form.photo_contest.help.winnersAt'
                ))
                ->add('type', 'choice', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.photo_contest.label.type',
                    'choices' => array(
                        '0' => 'form.photo_contest.label.type_geografic',
                        '1' => 'form.photo_contest.label.type_taxonomic',
                    )
                ))
                ->add('isJudge', null, array(
                    'label' => 'form.photo_contest.label.is_judge'
                ))
//                ->add('isVisible', 'checkbox', array(
//                    'label' => 'form.photo_contest.label.is_visible',
//                    'required' => false,
//                ))
//                ->add('createdAt', null, array(
//                    'years' => range(2010, 2030),
//                    'label' => 'form.photo_contest.label.created_at'
//                ))
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
