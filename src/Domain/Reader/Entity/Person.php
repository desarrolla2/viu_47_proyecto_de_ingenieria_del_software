<?php

namespace App\Domain\Reader\Entity;

readonly class Person
{
    public function __construct(private string $fullName, private string $number)
    {
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
