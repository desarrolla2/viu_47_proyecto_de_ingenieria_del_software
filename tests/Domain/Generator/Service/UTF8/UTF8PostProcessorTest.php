<?php

namespace App\Tests\Domain\Generator\Service\UTF8;

use App\Domain\Generator\Service\UTF8\UTF8PostProcessor;
use App\Domain\Generator\ValueObject\Text;
use PHPUnit\Framework\TestCase;

class UTF8PostProcessorTest extends TestCase
{
    public function testExecuteReturnsTextInUtf8()
    {
        $string = 'Texto con codificación diferente';

        $UTF8PostProcessor = new UTF8PostProcessor();
        $encodedText = mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');

        $processedText = $UTF8PostProcessor->execute(new Text($encodedText));
        $this->assertSame('UTF-8', mb_detect_encoding($processedText->content()));
        $this->assertEquals($string, $processedText->content());
    }
}
