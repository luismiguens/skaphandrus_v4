<?php

namespace Skaphandrus\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkIdentificationCriteriaForSpeciesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->addEventListener(\Symfony\Component\Form\FormEvents::PRE_SET_DATA, function (\Symfony\Component\Form\FormEvent $event) {
            $criteria = $event->getData();
            //dump($criteria);

            $form = $event->getForm();

// check if the Product object is "new"
// If no data is passed to the form, the data is "null".
// This should be considered a new "Product"

            $form->add('characters', 'entity', array(
                'class' => 'SkaphandrusAppBundle:SkIdentificationCharacter',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($criteria) {
                    return $er->createQueryBuilder('c')
                                    ->select('c')
                                    ->where('c.criteria = ?1 ')
                                    ->setParameter(1, $criteria->getId());
                }
            ));
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\AppBundle\Entity\SkIdentificationCriteria'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'skaphandrus_appbundle_skidentificationcriteria';
    }

}
