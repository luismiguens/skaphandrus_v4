<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Skaphandrus\AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of ContainsSufficientPoints
 *
 * @author Luis Miguens <luis.miguens@skaphandrus.com>
 */


class ContainsSufficientPoints extends Constraint
{
    public $message = 'the selected modules need %modules_points% points and you only have %user_points% points.';
    
    public function validatedBy()
    {
        return 'validator.contains_sufficient_points';
    }
}
