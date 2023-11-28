<?php

namespace Domain\Generator\Service\Dummy;

use Domain\Generator\Entity\Document;
use Domain\Generator\Service\PreProcessorInterface;

class DummyPreProcessor implements PreProcessorInterface
{
    public static function order()
    {
        return 0;
    }

    public function execute(Document $document): void
    {
        return;
    }
}
