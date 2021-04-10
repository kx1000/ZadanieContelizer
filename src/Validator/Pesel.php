<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Pesel extends Constraint
{
    public $message = 'Podany PESEL nie jest prawidłowy.';

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
