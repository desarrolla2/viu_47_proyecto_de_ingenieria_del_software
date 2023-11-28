<?php

namespace Domain\Generator\Service;

use Domain\Generator\ValueObject\Text;

interface PostProcessorInterface
{
    public static function order(): int;

    public function execute(Text $text): Text;
}
