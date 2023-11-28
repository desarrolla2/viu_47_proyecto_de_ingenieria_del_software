<?php

namespace Domain\Reader\Service;

use Domain\Reader\Entity\Document;
use Domain\Reader\Entity\Model\ModelInterface;

readonly class Engine
{
    public function __construct(private iterable $processors)
    {
    }

    public function execute(Document $document): ModelInterface
    {
        return $this->executeProcessor($document);
    }

    private function executeProcessor(Document $document): ModelInterface
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
