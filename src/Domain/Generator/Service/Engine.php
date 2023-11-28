<?php

namespace App\Domain\Generator\Service;

use App\Domain\Generator\Entity\Document;

readonly class Engine
{
    public function __construct(private iterable $preProcessors, private iterable $processors, private iterable $postProcessors)
    {
    }

    public function execute(Document $document): array
    {
        $this->executePreProcessors($document);
        $lines = $this->executeProcessor($document);

        return $this->executePostProcessors($lines);
    }

    private function executePostProcessors(array $lines): array
    {
        /** @var PostProcessorInterface $postProcessor */
        foreach ($this->postProcessors as $postProcessor) {
            $lines = $postProcessor->execute($lines);
        }

        return $lines;
    }

    private function executePreProcessors(Document $document): void
    {
        /** @var PreProcessorInterface $preProcessor */
        foreach ($this->preProcessors as $preProcessor) {
            $preProcessor->execute($document);
        }
    }

    private function executeProcessor(Document $document): array
    {
        $processor = $this->getProcessor($document);

        return $processor->execute($document);
    }

    private function getProcessor(Document $document): ProcessorInterface
    {
        $scores = [];
        /** @var ProcessorInterface $processor */
        foreach ($this->processors as $processor) {
            $scores[] = ['score' => $processor->score($document), 'processor' => $processor];
        }
        usort($scores, function (array $processor1, array $processor2) {
            return $processor2['score'] <> $processor1['score'];
        });

        return reset($scores)['processor'];
    }
}
