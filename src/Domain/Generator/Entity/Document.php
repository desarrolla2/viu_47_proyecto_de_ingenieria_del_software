<?php

namespace Domain\Generator\Entity;

readonly class Document
{
    public function __construct(private string $path)
    {
    }

    public function path(): string
    {
        return $this->path;
    }
}
