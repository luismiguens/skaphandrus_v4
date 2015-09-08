<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileSettingsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('observations', 'textarea',
                        array(
                            'attr' => array('class' => 'form-control','rows'=>'10'),
                            'label'=>'form.settings.label.about_you'
                            )
                        )
//                ->add('file', 'file', 
//                        array(
//                            'label'=>'form.settings.label.file',
//                            'required' => false
//                            )
//                        )
                
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.settings.label.file',
                    'required'      => false,
                    'allow_delete'  => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                    ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkSettings'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_sksettings';
    }

}
