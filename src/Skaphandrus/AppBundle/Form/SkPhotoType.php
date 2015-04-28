<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPhotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('image')
            ->add('description')
            ->add('views')
            ->add('takenAt')
            ->add('createdAt')
            ->add('creative')
            ->add('model')
            //->add('spot')
            //->add('species')
            //->add('fosUser')
            //->add('keyword')
            //->add('category')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhoto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skphoto';
    }
}
