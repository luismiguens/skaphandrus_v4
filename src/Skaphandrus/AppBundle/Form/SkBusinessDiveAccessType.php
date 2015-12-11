<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkBusinessDiveAccessType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('daydiveboat', 'checkbox', array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.day_dive_boat'
                ))
                ->add('shoredive', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.shore_dive'
                ))
                ->add('nightdive', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.night_dive'
                ))
                ->add('housereef', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.house_reef'
                ))
                ->add('daytours', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.day_tours'
                ))
                ->add('halfdaytours', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.half_day_tours'
                ))
                ->add('unguideddives', null, array(
                    'attr' => array('class' => 'checkbox'),
                    'label' => 'form.dive_access.label.unguided_dives'
                ))
                ->add('perdaydives', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_access.label.per_day_dives',
                    'help' => 'form.dive_access.help.per_day_dives'
                ))
                ->add('maxdepthdives', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_access.label.max_depth_dives',
                    'help' => 'form.dive_access.help.max_depth_dives'
                ))
                ->add('maxminutesdives', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_access.label.max_minutes_dives',
                    'help' => 'form.dive_access.help.max_minutes_dives'
                ))
                ->add('maxpersonsperdive', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_access.label.max_persons_per_dive',
                    'help' => 'form.dive_access.help.max_persons_per_dive'
                ))
                ->add('observations', null, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.dive_access.label.observations'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBusinessDiveAccess'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbusinessdiveaccess';
    }

}
