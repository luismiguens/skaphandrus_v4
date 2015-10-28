<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FosUserModulesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('modules', 'entity', array(
                    'class' => 'SkaphandrusAppBundle:SkIdentificationModule',
                    'property' => 'name',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($options) {
                        return $er->createQueryBuilder('m')
                                ->select('m')
                                ->where('m.isActive = 1');
                    }
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\FosUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_fosuser';
    }

}
