<?php

namespace Skaphandrus\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResettingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.new_password', 'class' => 'form-control')),
            'second_options' => array('label' => FALSE, 'attr' => array('placeholder' => 'form.new_password_confirmation', 'class' => 'form-control')),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }

    public function getParent()
    {
        return 'fos_user_resetting';
    }

    public function getName()
    {
        return 'skaphandrus_user_resetting';
    }
}
