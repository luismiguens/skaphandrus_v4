<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPersonType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('skaphandrusId', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:FosUser',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.person.label.user',
                    'required' => false,
                    'help' => 'form.person.help.user'
                ))
                ->add('persontype', 'entity', array(
                    'attr' => array('class' => 'checkbox'),
                    'class' => 'SkaphandrusAppBundle:SkPersonType',
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'form.person.label.persontype',
                    'help' => 'form.person.help.persontype'
                ))
                ->add('observations', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.person.label.observations',
                    'required' => false
                ))
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('fosUser')
//            ->add('business')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPerson'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skperson';
    }

}
