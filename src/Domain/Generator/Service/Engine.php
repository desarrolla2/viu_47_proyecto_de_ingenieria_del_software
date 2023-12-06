<?php

namespace App\Domain\Generator\Service;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\ValueObject\Text;

class Engine
{
    private array $preProcessors = [];
    private array $processors = [];
    private array $postProcessors = [];

    public function addPostProcessor(PostProcessorInterface $postProcessor): void
    {
        $this->postProcessors[] = $postProcessor;
    }

    public function addPreProcessor(PreProcessorInterface $preProcessor): void
    {
        $this->preProcessors[] = $preProcessor;
    }

    public function addProcessor(ProcessorInterface $processor): void
    {
        $this->processors[] = $processor;
    }

    public function execute(Document $document): Text
    {
        $this->executePreProcessors($document);
        $lines = $this->executeProcessor($document);

        return $this->executePostProcessors($lines);
    }

    private function executePostProcessors(Text $text): Text
    {
        /** @var PostProcessorInterface $postProcessor */
        foreach ($this->postProcessors as $postProcessor) {
            $text = $postProcessor->execute($text);
        }

        return $text;
    }

    private function executePreProcessors(Document $document): void
    {
        /** @var PreProcessorInterface $preProcessor */
        foreach ($this->preProcessors as $preProcessor) {
            $preProcessor->execute($document);
        }
    }

    private function executeProcessor(Document $document): Text
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
