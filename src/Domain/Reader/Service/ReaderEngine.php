<?php

namespace App\Domain\Reader\Service;

use App\Domain\Reader\Entity\AgreementInterface;
use App\Domain\Reader\ValueObject\Text;

class ReaderEngine
{
    private array $processors = [];

    public function addProcessor(ProcessorInterface $processor): void
    {
        $this->processors[] = $processor;
    }

    public function addProcessors($processors): void
    {
        foreach ($processors as $processor) {
            $this->addProcessor($processor);
        }
    }

    public function execute(Text $document): AgreementInterface
    {
        return $this->executeProcessor($document);
    }

    private function executeProcessor(Text $document): AgreementInterface
    {
        $processor = $this->getProcessor($document);

        return $processor->execute($document);
    }

    private function getProcessor(Text $document): ProcessorInterface
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
