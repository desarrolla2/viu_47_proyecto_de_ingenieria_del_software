<?php

namespace App\Tests\Domain\Generator\Service;

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
        $engine = new Engine([new DummyPreProcessor()], [new DummyProcessor()], [new DummyPostProcessor()]);

        $document = new Document('this_file_not_exist');
        $text = $engine->execute($document);

        $this->assertInstanceOf(Text::class, $text);
    }
}
