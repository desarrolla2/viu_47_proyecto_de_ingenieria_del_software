<?php

namespace Domain\Reader\Service\Dummy;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\DummyAgreement;
use Domain\Reader\Entity\Model\AgreementInterface;
use Domain\Reader\Service\ProcessorInterface;

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
