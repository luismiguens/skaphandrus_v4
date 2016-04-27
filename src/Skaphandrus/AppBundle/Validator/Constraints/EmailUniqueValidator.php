<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Skaphandrus\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Translation\Translator;

/**
 * Description of ContainsSufficientPointsValidator
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */
class EmailUniqueValidator extends ConstraintValidator {

    protected $translator;
    protected $container;

    public function __construct($translator, $container) {
        $this->translator = $translator;
        $this->container = $container;
    }

    public function validate($email, Constraint $constraint) {

        
        $em = $this->container->get('doctrine')->getEntityManager('default');
        
        //validate if user already exists on database
        $query = $em->createQuery("SELECT u FROM SkaphandrusAppBundle:FosUser u WHERE u.email = :email");
        $query->setParameter('email', $email);
        $user = $query->getOneOrNullResult();
        //email already exists
        if ($user) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('%email%', $email)
                    ->addViolation();
        }
    }

}
