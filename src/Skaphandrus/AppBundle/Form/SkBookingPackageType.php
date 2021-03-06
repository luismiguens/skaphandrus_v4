<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Skaphandrus\AppBundle\Entity\Repository\SkBusinessDivePriceRepository;

class SkBookingPackageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $business_id = $options['business_id'];
        
        $builder
                ->add('bookingPackage', 'entity', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking_package.label.bookingPackage',
                    'class' => 'SkaphandrusAppBundle:SkBusinessDivePrice',
                    'query_builder' => function (SkBusinessDivePriceRepository $er) use($business_id) {
                        return $er->createQueryBuilder('p')
                                ->orWhere('p.business = ?1')
                                ->setParameter(1, $business_id);
                    },
                    'required' => true
                ))
                ->add('quantity', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_package.label.quantity',
                    'data' => 1
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkBookingPackage',
            'business_id' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skbookingpackage';
    }

}
