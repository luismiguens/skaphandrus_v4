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
                    'label' => 'form.settings.label.language'
                ))
                ->add('emailMessageAtOnce', 'checkbox', array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.settings.label.email_message_once',
                    'help' => 'form.settings.help.email_message_at_once'
                ))
                ->add('emailCommentAtOnce', 'checkbox', array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.settings.label.email_comment_once',
                    'help' => 'form.settings.help.email_comment_at_once'
                ))
                ->add('emailUpdate', 'checkbox', array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.settings.label.email_update_skaphandrus',
                    'help' => 'form.settings.help.email_update'
                ))
                ->add('emailNotificationTime', 'entity', array(
                    'class' => 'SkaphandrusAppBundle:SkEmailNotificationTime',
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.settings.label.email_notification_time',
                    'help' => 'form.settings.help.email_notification_time'
                ))
                ->add('facebookUid', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.settings.label.facebook_id',
                    'required' => false
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
