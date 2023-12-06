<?php

namespace App\Domain\Generator\Service\PdfToText;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\ProcessorInterface;
use App\Domain\Generator\ValueObject\Text;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PdfToTextProcessor implements ProcessorInterface
{
    private const PDF_TO_TEXT = 'pdftotext';

    public function execute(Document $document): Text
    {
        $output = sprintf('%s/%s.txt', sys_get_temp_dir(), hash('sha256', uniqid(get_called_class(), true)));

        $this->command([self::PDF_TO_TEXT, $document->path(), $output]);

        $content = file_get_contents($output);

        $this->command(['rm', '-rf', $output]);

        return new Text($content);
    }

    public function score(Document $document): int
    {
        return 50;
    }

    private function command(array $command): void
    {
        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
