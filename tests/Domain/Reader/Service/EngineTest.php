<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\DummyAgreement;
use Domain\Reader\Service\Dummy\DummyProcessor;
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
        $engine = new Engine([new DummyProcessor()],);

        $document = new Document($fileName);
        $text = $engine->execute($document);

        $this->assertInstanceOf(DummyAgreement::class, $text);
    }
}
