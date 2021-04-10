<?php

namespace App\Command;

use App\Utils\TextRandomizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * php bin/console randomize:text-file
 */
class RandomizeTextFileCommand extends Command
{
    const INPUT_FILE = 'src/Command/txts/input.txt';
    const OUTPUT_FILE = 'src/Command/txts/output.txt';

    protected static $defaultName = 'randomize:text-file';

    private TextRandomizer $textRandomizer;

    public function __construct(TextRandomizer $textRandomizer, $name = null)
    {
        parent::__construct($name);
        $this->textRandomizer = $textRandomizer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $inputFileContent = file_get_contents(self::INPUT_FILE);
        $randomizedContent = $this->textRandomizer->randomize($inputFileContent);
        file_put_contents(self::OUTPUT_FILE, $randomizedContent);

        $io->success('Przemieszano!');

        return 0;
    }
}
