<?php

namespace App\Domain\Reader\Service\Dummy;

use App\Domain\Reader\Entity\Document;
use App\Domain\Reader\Entity\Model\DummyAgreement;
use App\Domain\Reader\Entity\Model\AgreementInterface;
use App\Domain\Reader\Service\ProcessorInterface;

class DummyProcessor implements ProcessorInterface
{
    public function execute(Document $document): AgreementInterface
    {
        return new DummyAgreement();
    }

    public function score(Document $document): int
    {
        return 0;
    }
}
