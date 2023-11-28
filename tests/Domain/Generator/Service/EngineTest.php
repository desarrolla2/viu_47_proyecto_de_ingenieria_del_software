<?php

namespace Domain\Generator\Service;

use Domain\Generator\Entity\Document;
use Domain\Generator\Service\Dummy\DummyPostProcessor;
use Domain\Generator\Service\Dummy\DummyPreProcessor;
use Domain\Generator\Service\Dummy\DummyProcessor;
use Domain\Generator\ValueObject\Text;
use PHPUnit\Framework\TestCase;

class EngineTest extends TestCase
{
    public function testDummyProcessor()
    {
        $engine = new Engine([new DummyPreProcessor()], [new DummyProcessor()], [new DummyPostProcessor()]);

        $document = new Document();
        $text = $engine->execute($document);

        $this->assetInstanceOf(Text::class, $text);
    }
}
