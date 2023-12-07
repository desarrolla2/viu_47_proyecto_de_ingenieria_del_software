<?php

namespace App\Domain\Generator\Service\UTF8;

use App\Domain\Generator\Service\PostProcessorInterface;
use App\Domain\Generator\ValueObject\Text;

class UTF8PostProcessor implements PostProcessorInterface
{
    public static function order(): int
    {
        return 100;
    }

    public function execute(Text $text): Text
    {
        return new Text(mb_convert_encoding($text->content(), 'UTF-8'));
    }
}
