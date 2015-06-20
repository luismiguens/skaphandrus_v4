<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkPersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skaphandrusId', 'autocomplete', 
                        array(
                            'class' => 'SkaphandrusAppBundle:FosUser',
                            'attr' => array('class' => 'form-control m-b'),
                            'label'=>'form.person.label.user', 
                            'required' => false
                            )
                        )
            ->add('observations')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('fosUser')
//            ->add('business')
            ->add('persontype')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPerson'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skperson';
    }
}
