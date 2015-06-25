<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPersonalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('honorific')
            ->add('firstname')
            ->add('middlename')
            ->add('lastname')
            ->add('birthname')
            ->add('height')
            ->add('weight')
            ->add('smoking')
            ->add('birthdate')
            ->add('passport')
            ->add('bloodgroup')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('fosUser')
            ->add('sexType')
            ->add('person')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPersonal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skpersonal';
    }
}
