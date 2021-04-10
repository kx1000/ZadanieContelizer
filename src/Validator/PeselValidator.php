<?php

namespace App\Validator;

use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PeselValidator extends ConstraintValidator
{
    private const WEIGHTS = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Pesel */

        if (null === $value || '' === $value) {
            return;
        }

        try {
            $this->checkValidityFormat($value);
            $this->checkValidityControlSum($value);
        } catch (InvalidArgumentException $ex) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function checkValidityFormat(string $value): void
    {
        if (!preg_match('/^[0-9]{11}$/', $value)) {
            throw new InvalidArgumentException();
        }
    }

    private function checkValidityControlSum(string $value): void
    {
        $digits = str_split($value);
        $controlSumFromValue = (int) array_pop($digits);

        $sum = 0;
        foreach ($digits as $key=>$digit) {
            $score = $digit * self::WEIGHTS[$key];
            $sum += substr($score, -1);
        }

        $scoreControlSum = 10 - substr($sum, -1);

        if ($scoreControlSum !== $controlSumFromValue) {
            throw new InvalidArgumentException();
        }
    }
}
