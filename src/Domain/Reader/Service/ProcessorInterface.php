<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\AgreementInterface;

interface ProcessorInterface
{
    public function execute(Document $document): AgreementInterface;

    public function score(Document $document): int;
}
