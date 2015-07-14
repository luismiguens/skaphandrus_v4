<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkSettingsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('language', 'choice', array(
                    'choices' => array('en' => 'English', 'pt' => 'Português'),  
                    'attr' => array('class' => 'form-control'),
                    'label'=>'form.settings.label.language'
                    ))
                ->add('emailMessageAtOnce', 'checkbox',
                        array(
                            'label'=>'form.settings.label.email_message_once'
                            ))
                ->add('emailCommentAtOnce', 'checkbox',
                        array(
                            'label'=>'form.settings.label.email_comment_once'
                            ))
                ->add('emailUpdate', 'checkbox',
                        array(
                            'label'=>'form.settings.label.email_update_skaphandrus'
                            ))
                ->add('emailNotificationTime', 'entity',
                        array(
                            'class' => 'SkaphandrusAppBundle:SkEmailNotificationTime', 
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.settings.label.email_notification_time'
                            )
                        )
                ->add('facebookUid','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.settings.label.facebook_id'
                            ))
        //->add('points')
        //->add('fosUser')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSettings'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_sksettings';
    }

}