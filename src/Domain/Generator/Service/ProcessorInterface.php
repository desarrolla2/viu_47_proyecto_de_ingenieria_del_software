<?php

namespace Domain\Generator\Service;

use Domain\Generator\Entity\Document;
use Domain\Generator\ValueObject\Text;

interface ProcessorInterface
{
    public function execute(Document $document): Text;

    public function score(Document $document): int;
}
