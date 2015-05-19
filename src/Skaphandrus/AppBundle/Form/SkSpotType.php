<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkSpotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxDepth')
            ->add('coordinate')
            ->add('zoom')
            //->add('isAproved')
            //->add('createdAt')
            ->add('updatedAt')
            //->add('fosUser')
                            ->add('location', 'autocomplete', 
                        array(
                            'class' => 'SkaphandrusAppBundle:SkLocation',
                            'attr' => array('class' => 'form-control m-b'),
                            'label'=>'form.photo.label.location', 
                            'required' => false
                            )
                        )
                 ->add('translations', 'a2lix_translations')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSpot'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skspot';
    }
}
