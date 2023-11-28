<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;

interface ProcessorInterface
{
    public function execute(Document $document): array;

    public function score(Document $document): int;
}
