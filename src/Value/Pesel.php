<?php

namespace App\Value;

use Symfony\Component\Validator\Constraints as Assert;

class Pesel
{
    /**
     * @Assert\NotNull
     * @\App\Validator\Pesel
     */
    private ?string $number;

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }
}