<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\DummyAgreement;
use Domain\Reader\Service\Dummy\DummyProcessor;
use PHPUnit\Framework\TestCase;

class DummyProcessorTest extends TestCase
{
    public function testDummyProcessor()
    {
        $engine = new Engine([new DummyProcessor()],);

        $document = new Document();
        $text = $engine->execute($document);

        $this->assertInstanceOf(DummyAgreement::class, $text);
    }

}
