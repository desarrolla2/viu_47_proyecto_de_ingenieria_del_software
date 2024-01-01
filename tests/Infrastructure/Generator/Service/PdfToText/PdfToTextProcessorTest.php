<?php

namespace App\Tests\Infrastructure\Generator\Service\PdfToText;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\GeneratorEngine;
use App\Infrastructure\Component\CommandRunner\SymfonyCommandRunner;
use App\Infrastructure\Generator\Service\PdfToText\PdfToTextProcessor;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class PdfToTextProcessorTest extends TestCase
{
    public function dataProviderForTestProcessor(): array
    {
        return [
            ['/var/www/tests/data/output/001.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/002.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/003.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/004.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/005.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
            ['/var/www/tests/data/output/006.pdf', ['CONTRATO DE ARRENDAMIENTO DE VIVIENDA']],
        ];
    }

    /** @dataProvider dataProviderForTestProcessor */
    public function testProcessor(string $fileName, array $stringsRequired): void
    {
        $engine = new GeneratorEngine(new NullLogger());
        $engine->addProcessor(new PdfToTextProcessor(new SymfonyCommandRunner()));
        $document = new Document($fileName);
        $text = $engine->execute($document);

        foreach ($stringsRequired as $stringRequired) {
            $this->assertStringContainsString($stringRequired, $text->content());
        }
    }
}
