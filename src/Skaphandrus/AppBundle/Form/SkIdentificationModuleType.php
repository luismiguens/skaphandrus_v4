<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\File;

class SkIdentificationModuleType extends AbstractType
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
            ->add('appstoreId')
            ->add('googleplayId')
            ->add('master')
            ->add('isActive')//se está concluido pelos biologos
            ->add('isEnabled')
            ->add('isFree')
            //->add('image')
//            ->add('file', 'file', array(
//                'label' => 'form.identification_module.label.file',
//                'required' => false
//            ))
//                 ->add('file', 'file', array(
//                    'label' => 'form.identification_module.label.file',
//                    'constraints' => new File(array(
//                        'maxSize' => '10M',
//                        'mimeTypes' => array("image/jpeg")
//                            )),
//                    'required' => false
//                        )
//                )
            ->add('imageFile', 'vich_image', array(
                'label' => 'form.identification_module.label.file',
                'required'      => false,
                'allow_delete'  => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
                )) 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationModule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_appbundle_skidentificationmodule';
    }
}
