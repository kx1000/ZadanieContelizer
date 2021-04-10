<?php

namespace App\Command;

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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $inputFileContent = file_get_contents(self::INPUT_FILE);
        $randomifiedContent = preg_replace_callback("/[a-zA-Ząćęłńóśźż]+/ui", function(array $word) {
            return $this->randomifyWord($word[0]);
        }, $inputFileContent);

        file_put_contents(self::OUTPUT_FILE, $randomifiedContent);

        $io->success('');

        return 0;
    }

    private function randomifyWord(string $word): string
    {
        $countChars = mb_strlen($word);

        if (3 >= $countChars) { // trzyliterowy wyraz również nie zostanie wymieszany
            return $word;
        }

        $chars = mb_str_split($word);
        $startChar = array_shift($chars);
        $endChar = array_pop($chars);

        return $startChar . $this->mbStrShuffle(implode($chars)) . $endChar;
    }

    /**
     * Miesza znaki w stringu
     *
     * str_shuffle i shuffle psuje kodowanie, brakuje funkcji obsługjącej znaki Multibyte
     */
    private function mbStrShuffle(string $str): string
    {
        preg_match_all('/./u', $str, $temp);
        shuffle($temp[0]);
        $str = join("", $temp[0]);
        return $str;
    }
}
