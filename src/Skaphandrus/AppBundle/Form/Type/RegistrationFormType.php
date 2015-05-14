<?php

namespace Skaphandrus\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => FALSE, 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control', 'placeholder' => 'form.email')))
            ->add('username', null, array('label' => FALSE, 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control', 'placeholder' => 'form.username')))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.password', 'class' => 'form-control')),
                'second_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.password_confirmation', 'class' => 'form-control')),
                'invalid_message' => 'fos_user.password.mismatch',
            ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'skaphandrus_user_registration';
    }
}
