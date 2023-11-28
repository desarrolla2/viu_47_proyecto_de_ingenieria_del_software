<?php

namespace Domain\Generator\Service\Dummy;

use Domain\Generator\Service\PostProcessorInterface;
use Domain\Generator\ValueObject\Text;

class DummyPostProcessor implements PostProcessorInterface
{
    public static function order(): int
    {
        return 0;
    }

    public function execute(Text $text): Text
    {
        return $text;
    }
}
