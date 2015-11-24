<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\File;

class SkPhotoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $entity = $builder->getData();
        $required = true;

        //se estiver no edit, imagem nao é obrigatoria
        if ($entity->getId()):
            $required = false;
        endif;

        $builder
                ->add('title', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo.label.title'
                ))
//                ->add('file', 'file', array(
//                    'label' => 'form.photo.label.file',
//                    'constraints' => new File(array(
//                        'maxSize' => '10M',
//                        'mimeTypes' => array("image/jpeg")
//                            )),
//                    'required' => false
//                        )
//                )
                ->add('imageFile', 'vich_image', array(
                    'label' => 'form.photo.label.file',
                    'help' => 'form.photo.help.imageFile',
                    'required' => $required,
                    'allow_delete' => false, // not mandatory, default is true
                    'download_link' => false, // not mandatory, default is true
                ))
                ->add('description', 'textarea', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo.label.description',
                    'required' => false
                ))
                //->add('views')
                ->add('takenAt', 'datetime', array(
                    'label' => 'form.photo.label.taken_at',
                    'date_widget' => "single_text",
                    'time_widget' => "single_text",
                ))
                //->add('createdAt', 'hidden')
                ->add('creative', 'entity', array(
                    'class' => 'SkaphandrusAppBundle:SkCreativeCommons',
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.photo.label.creative'
                ))
                ->add('model', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkPhotoMachineModel',
                    'attr' => array('class' => ''),
                    'label' => 'form.photo.label.model',
                    'required' => false,
                    'help' => 'form.photo.help.model'
                ))
                ->add('spot', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkSpot',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.photo.label.spot',
                    'required' => false,
                    'help' => 'form.photo.help.spot'
                ))
                ->add('species', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkSpecies',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.photo.label.species',
                    'required' => false,
                    'help' => 'form.photo.help.species'
                ))
//                ->add('fosUser', 'hidden', 
//                        array(
//                            'data_class' => 'Skaphandrus\AppBundle\Entity\FosUser',
//                            'required' => true
//                            )
//                        )
        //->add('keyword')
        //->add('category')
        //->add('cancel', 'submit', array('label' => 'form.common.btn.cancel','attr' => array('class' => 'btn btn-primary')))
        //->add('submit', 'submit', array('label' => 'form.common.btn.save','attr' => array('class' => 'btn btn-primary')))


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkPhoto'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skphoto';
    }

}
