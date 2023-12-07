<?php

namespace App\Domain\Generator\Component\CommandRunner;

interface CommandRunnerInterface
{
    public function run(array $command): string;
}
