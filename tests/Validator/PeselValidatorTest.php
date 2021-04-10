<?php

namespace App\Tests\Validator;

use App\Validator\Pesel;
use App\Validator\PeselValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class PeselValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new PeselValidator();
    }

    public function getValidPesels(): \Generator
    {
        yield ['94070911515'];
        yield ['99070804162'];
    }

    /**
     * @dataProvider getValidPesels
     */
    public function testConstraintWithValidPesel(string $pesel): void
    {
        $constraint = new Pesel();
        $this->validator->validate($pesel, $constraint);
        $this->assertNoViolation();
    }

    public function getInvalidPesels(): \Generator
    {
        yield ['123'];
        yield ['94070911516']; // błędna suma kontrolna
        yield ['12345678901'];
        yield ['99999999999'];
        yield ['11111111111'];
    }

    /**
     * @dataProvider getInvalidPesels
     */
    public function testValidationError(string $pesel): void
    {
        $constraint = new Pesel();

        $this->validator->validate($pesel, $constraint);

        $this->buildViolation('Podany PESEL nie jest prawidłowy.')
            ->setParameter('{{ value }}', $pesel)
            ->assertRaised();
    }
}
