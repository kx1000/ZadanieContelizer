<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * php bin/console randomify:text-file
 */
class RandomifyTextFileCommand extends Command
{
    const INPUT_FILE = 'src/Command/txts/input.txt';
    const OUTPUT_FILE = 'src/Command/txts/output.txt';
    protected static $defaultName = 'randomify:text-file';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $inputFileContent = file_get_contents(self::INPUT_FILE);

        $randomifiedContent = preg_replace_callback("/[a-zA-Ząćęłńóśźż]*/", function(array $word) {
            return $this->randomifyWord($word[0]);
        }, $inputFileContent);

        dump($randomifiedContent);

        file_put_contents(self::OUTPUT_FILE, $randomifiedContent);

        $io->success('');

        return 0;
    }

    private function randomifyWord(string $word): string
    {
        $chars = str_split($word);

        if (3 >= count($chars)) { // trzyliterowy wyraz również nie zostanie wymieszany
            return $word;
        }

        $startChar = array_shift($chars);
        $endChar = array_pop($chars);
        shuffle($chars);

        return $startChar . implode($chars) . $endChar;
    }
}
