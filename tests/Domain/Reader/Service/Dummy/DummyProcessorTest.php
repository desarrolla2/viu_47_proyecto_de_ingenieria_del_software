<?php

namespace App\Tests\Domain\Reader\Service\Dummy;

use App\Domain\Reader\Entity\Document;
use App\Domain\Reader\Entity\Model\DummyAgreement;
use App\Domain\Reader\Service\Dummy\DummyProcessor;
use App\Domain\Reader\Service\Engine;
use PHPUnit\Framework\TestCase;

class DummyProcessorTest extends TestCase
{
    public function testProcessor()
    {
        $engine = new Engine([new DummyProcessor()],);

        $document = new Document();
        $text = $engine->execute($document);

        $this->assertInstanceOf(DummyAgreement::class, $text);
    }

}
