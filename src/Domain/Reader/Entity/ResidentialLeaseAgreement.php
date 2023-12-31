<?php

namespace App\Domain\Reader\Entity;

class ResidentialLeaseAgreement implements AgreementInterface
{
    private array $landLords = [];
    private array $tenants = [];

    public function addLandLord(Person $person): void
    {
        $this->landLords[$person->getNumber()] = $person;
    }

    public function addTenant(Person $person): void
    {
        $this->tenants[$person->getNumber()] = $person;
    }

}
