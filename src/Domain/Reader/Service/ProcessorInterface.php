<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\ModelInterface;

interface ProcessorInterface
{
    public function execute(Document $document): ModelInterface;

    public function score(Document $document): int;
}
