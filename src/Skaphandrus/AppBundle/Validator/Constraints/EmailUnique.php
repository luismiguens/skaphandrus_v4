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


class EmailUnique extends Constraint
{
    public $message = 'the email %email% already exists';
    
    public function validatedBy()
    {
        return 'validator.email_unique';
    }
}
