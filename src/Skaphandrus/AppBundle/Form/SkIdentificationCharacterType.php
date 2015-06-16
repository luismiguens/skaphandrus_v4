<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationCharacterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'name' => array(
                        'attr' => array('class' => 'form-control'),
                    )
                )
            ))
            ->add('file', 'file', 
                array(
                    'label'=>'form.identification_character.label.file',
                    'required' => false
                )
            )
            // ->add('criteria', 'entity', array(
            //     'class' => 'SkaphandrusAppBundle:SkIdentificationCriteria',
            // ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationCharacter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skidentificationcharacter';
    }
}
