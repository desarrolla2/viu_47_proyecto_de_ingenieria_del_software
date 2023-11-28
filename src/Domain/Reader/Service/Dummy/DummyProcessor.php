<?php

namespace Domain\Reader\Service\Dummy;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\DummyModel;
use Domain\Reader\Entity\Model\ModelInterface;
use Domain\Reader\Service\ProcessorInterface;

class DummyProcessor implements ProcessorInterface
{
    public function execute(Document $document): ModelInterface
    {
        return new DummyModel();
    }

    public function score(Document $document): int
    {
        return 0;
    }
}
