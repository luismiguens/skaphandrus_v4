<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Skaphandrus\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Description of ContainsSufficientPointsValidator
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */
class ContainsSufficientPointsValidator extends ConstraintValidator {

    public function validate($acquisitions, Constraint $constraint) {

        $sum_selected_points = 0;
        //somar pontos tendo em consideração apenas questoes definitivas.
        // 1 - modulo não é gratuito (is_free=false)
        // 2 - modulo não foi comprado (store=2)
        // 3 - aquisition is null (quer dizer que é novo = está checado)

        foreach ($acquisitions as $key => $acquisition) {

            dump($acquisition);
            
            if ($acquisition->getModule()->getIsFree() != TRUE 
                    and $acquisition->getAcquisitionType() != 2 
                    and $acquisition->getId() == null) {
                $sum_selected_points = $sum_selected_points + $acquisition->getModule()->getPoints();
            }
        }

        if ($sum_selected_points > $acquisition->getFosUser()->getSettings()->getPoints()) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('%modules_points%', $sum_selected_points)->setParameter('%user_points%', $acquisition->getFosUser()->getSettings()->getPoints())
                    ->addViolation();
        }



        //$this->context->buildViolation($acquisition->getFosUser()->getSettings()->getPoints())->addViolation();
    }

}
