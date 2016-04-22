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
        
        dump($business_id);
        //dump($builder->getData());
          //      $sk_booking = new \Skaphandrus\AppBundle\Entity\SkBooking();
        //$sk_booking = $builder->getData();
        
        
        //$business = $sk_booking->getBusiness()
        
        
        $builder
                ->add('bookingPackage', 'entity', array(
                    'attr' => array('class' => 'form-control m-b'),
                    'label' => 'form.booking_package.label.bookingPackage',
                    'class' => 'SkaphandrusAppBundle:SkBusinessDivePrice',
                    'query_builder' => function (SkBusinessDivePriceRepository $er) {
                        return $er->createQueryBuilder('p')
                                ->orWhere('p.business = ?1')
                                ->setParameter(1, 1977);
                    },
                    'required' => true
                ))
                ->add('quantity', null, array(
                    'attr' => array('class' => 'form-control', 'min' => 1,),
                    'label' => 'form.booking_package.label.quantity'
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
