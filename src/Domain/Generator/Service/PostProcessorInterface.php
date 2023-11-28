<?php

namespace Domain\Generator\Service;

interface PostProcessorInterface
{
    public static function order();

    public function execute(array $lines): array;
}
