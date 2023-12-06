<?php

namespace App\Tests\Domain\Generator\Service\PdfToText;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\Engine;
use App\Domain\Generator\Service\PdfToText\PdfToTextProcessor;
use PHPUnit\Framework\TestCase;

class PdfToTextProcessorTest extends TestCase
{
    public function dataProviderForTestPdfToTextProcessor(): array
    {
        return [
            ['/var/www/tests/data/output/001.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/002.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/003.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/004.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/005.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/006.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/007.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/008.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
        ];
    }

    /** @dataProvider dataProviderForTestPdfToTextProcessor */
    public function testPdfToTextProcessor(string $fileName, array $stringsRequired): void
    {
        $engine = new Engine();
        $engine->addProcessor(new PdfToTextProcessor());
        $document = new Document($fileName);
        $text = $engine->execute($document);

        foreach ($stringsRequired as $stringRequired) {
            $this->assertStringContainsString($stringRequired, $text->content());
        }
    }

}
