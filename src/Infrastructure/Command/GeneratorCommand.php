<?php

namespace App\Infrastructure\Command;

use App\Domain\Generator\Entity\Document;
use App\Domain\Generator\Service\GeneratorEngine;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generator:run',
    description: 'Add a short description for your command',
)]
class GeneratorCommand extends Command
{
    public function __construct(private readonly GeneratorEngine $engine)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('input', InputArgument::REQUIRED, 'path to file')
            ->addArgument('output', InputArgument::REQUIRED, 'path to file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $inputArgument = $input->getArgument('input');
        $outputArgument = $input->getArgument('output');

        $document = new Document($inputArgument);
        $text = $this->engine->execute($document);

        file_put_contents($outputArgument, $text->content());

        dump($text);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
