<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationSpeciesImageRefType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageUrl')
            ->add('imageSrc')
            ->add('isPrimary', 'checkbox', array(
                'label'    => 'form.identification_species.label.primary',
                'required' => FALSE
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpeciesImageRef'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skspeciesimageref';
    }
}
