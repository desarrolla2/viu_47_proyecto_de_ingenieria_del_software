<?php

namespace Domain\Generator\Service;

use Domain\Generator\Entity\Document;

interface ProcessorInterface
{
    public function execute(Document $document): array;

    public function score(Document $document): int;
}
