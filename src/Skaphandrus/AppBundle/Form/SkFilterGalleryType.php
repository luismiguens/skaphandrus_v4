<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SkFilterGalleryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fosUser', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:FosUser',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.fosUser',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.fosUser'
                ))
                ->add('spot', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.filter_gallery.label.spot',
                    'required' => false
                ))
                ->add('location', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkLocation',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.location',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.location'
                ))
                ->add('region', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkRegion',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.region',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.region'
                ))
                ->add('country', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.filter_gallery.label.country',
                    'required' => false
                ))
//                ->add('country', 'autocomplete', array(
//                    'class' => 'SkaphandrusAppBundle:SkCountry',
//                    'attr' => array('class' => 'form-control m-b'),
//                    'label' => 'form.filter_gallery.label.country',
//                    'required' => false,
//                    'help' => 'form.filter_gallery.help.country'
//                ))
                ->add('vernacular', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'form.filter_gallery.label.vernacular',
                    'required' => false
                ))
                ->add('species', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkSpecies',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.species',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.species'
                ))
                ->add('genus', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkGenus',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.genus',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.genus'
                ))
                ->add('family', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkFamily',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.family',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.family'
                ))
                ->add('order', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkOrder',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.order',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.order'
                ))
                ->add('class', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkClass',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.class',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.class'
                ))
                ->add('phylum', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkPhylum',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.phylum',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.phylum'
                ))
                ->add('kingdom', 'autocomplete', array(
                    'class' => 'SkaphandrusAppBundle:SkKingdom',
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.filter_gallery.label.kingdom',
                    'required' => false,
                    'help' => 'form.filter_gallery.help.kingdom'
                ))
        ;
    }

    public function getName() {
        return 'skaphandrus_filter_gallery';
    }

}
