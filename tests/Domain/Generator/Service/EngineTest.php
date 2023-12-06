<?php

namespace App\Tests\Domain\Generator\Service;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\Dummy\DummyPostProcessor;
use App\Domain\Generator\Service\Dummy\DummyPreProcessor;
use App\Domain\Generator\Service\Dummy\DummyProcessor;
use App\Domain\Generator\Service\Engine;
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
