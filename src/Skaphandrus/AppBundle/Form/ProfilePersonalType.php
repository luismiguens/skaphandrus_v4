<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Skaphandrus\AppBundle\Entity\Repository\SkSexTypeRepository;

class ProfilePersonalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('honorific','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.honorific',
                            
                            ))
            ->add('firstname','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.firstname'
                            ))
            ->add('middlename','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.middlename'
                            ))
            ->add('lastname','text',
                        array(
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.lastname'
                            ))
            //->add('birthname')
            //->add('height')
            //->add('weight')
            //->add('smoking')
            ->add('birthdate','date',
                        array(
                            //'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.birthdate'
                            ))
            //->add('passport')
            //->add('bloodgroup')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('fosUser')
            ->add('sexType','entity',
                        array(
                            'class' => 'SkaphandrusAppBundle:SkSexType', 
                            'query_builder' => function (SkSexTypeRepository $er) {
        return $er->createQueryBuilder('s')
                ->orWhere('s.id = ?1')
                ->orWhere('s.id = ?2')
                ->setParameter(1, 2)
                ->setParameter(2, 3);
    },
                            'attr' => array('class' => 'form-control'),
                            'label'=>'form.personal.label.sexType'
                            ))
            //->add('person')
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
