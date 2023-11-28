<?php

namespace Domain\Generator\Service\Dummy;

use Domain\Generator\Entity\Document;
use Domain\Generator\Service\ProcessorInterface;
use Domain\Generator\ValueObject\Text;

class DummyProcessor implements ProcessorInterface
{
    public function execute(Document $document): Text
    {
        return new Text();
    }

    public function score(Document $document): int
    {
        return 0;
    }
}
