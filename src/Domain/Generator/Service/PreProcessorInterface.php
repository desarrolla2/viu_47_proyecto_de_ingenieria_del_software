<?php

namespace Domain\Generator\Service;

use Domain\Generator\Entity\Document;

interface PreProcessorInterface
{
    public static function order();

    public function execute(Document $document): void;
}
