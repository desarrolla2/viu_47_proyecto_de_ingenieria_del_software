<?php

namespace App\Tests\Domain\Generator\Service\Dummy;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\Dummy\DummyPostProcessor;
use App\Domain\Generator\Service\Dummy\DummyPreProcessor;
use App\Domain\Generator\Service\Dummy\DummyProcessor;
use App\Domain\Generator\Service\Engine;
use App\Domain\Generator\ValueObject\Text;
use PHPUnit\Framework\TestCase;

class DummyProcessorTest extends TestCase
{
    public function testDummyProcessor()
    {
        $engine = new Engine();
        $engine->addPreProcessor(new DummyPreProcessor());
        $engine->addProcessor(new DummyProcessor());
        $engine->addPostProcessor(new DummyPostProcessor());

        $document = new Document('/var/www/tests/data/output/001.pdf');
        $text = $engine->execute($document);

        $this->assertInstanceOf(Text::class, $text);
    }
}
