<?php

namespace Skaphandrus\AppBundle\Form\FOSMessage;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Message form type for starting a new conversation
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class NewThreadMessageFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                #->add('recipient', 'fos_user_username')
                ->add('recipient', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:FosUser',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.new_message.label.user',
                    'required' => false,
                    'help' => 'form.new_message.help.recipient'
                ))
                ->add('subject', 'text')
                ->add('body', 'textarea');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'intention' => 'message',
        ));
    }

    // public function getParent()
    // {
    //     return 'fos_message_new_thread';
    // }

    public function getName() {
        return 'skaphandrus_message_new_thread';
    }

}
