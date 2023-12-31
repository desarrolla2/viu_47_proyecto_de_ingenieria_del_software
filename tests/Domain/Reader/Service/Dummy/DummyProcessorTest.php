<?php

namespace App\Tests\Domain\Reader\Service\Dummy;

use App\Domain\Reader\Entity\DummyAgreement;
use App\Domain\Reader\Service\Dummy\DummyProcessor;
use App\Domain\Reader\Service\ReaderEngine;
use App\Domain\Reader\ValueObject\Text;
use PHPUnit\Framework\TestCase;

class DummyProcessorTest extends TestCase
{
    public function testProcessor()
    {
        $engine = new ReaderEngine([new DummyProcessor()],);

        $document = new Text();
        $text = $engine->execute($document);

        $this->assertInstanceOf(DummyAgreement::class, $text);
    }

}
