<?php

namespace App\Domain\Reader\Service;

use App\Domain\Reader\Entity\Document;
use App\Domain\Reader\Entity\Model\AgreementInterface;

interface ProcessorInterface
{
    public function execute(Document $document): AgreementInterface;

    public function score(Document $document): int;
}
