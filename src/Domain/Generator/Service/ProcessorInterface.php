<?php

namespace App\Domain\Generator\Service;

use App\Domain\Generator\Entity\Document;

interface ProcessorInterface
{
    public function execute(Document $document): array;

    public function score(Document $document): int;
}
