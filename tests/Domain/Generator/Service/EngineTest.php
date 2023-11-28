<?php

namespace Domain\Generator\Service;

use Domain\Generator\Entity\Document;
use Domain\Generator\Service\Dummy\DummyPostProcessor;
use Domain\Generator\Service\Dummy\DummyPreProcessor;
use Domain\Generator\Service\Dummy\DummyProcessor;
use PHPUnit\Framework\TestCase;

class EngineTest extends TestCase
{
    public function dataProviderForTestEngine(): array
    {
        return [
            ['01.doc', 'hash'],
            ['02.doc', 'hash'],
            ['03.doc', 'hash'],
            ['04.doc', 'hash'],
            ['05.doc', 'hash'],
            ['06.doc', 'hash'],
            ['07.doc', 'hash'],
            ['08.doc', 'hash'],
        ];
    }

    /** @dataProvider dataProviderForTestEngine */
    public function testEngine(string $fileName, string $hash): void
    {
        $engine = new Engine([new DummyPreProcessor()], [new DummyProcessor()], [new DummyPostProcessor()]);

        $document = new Document($fileName);
        $text = $engine->execute($document);

        $this->assertEquals($hash, $text->hash());
    }
}
