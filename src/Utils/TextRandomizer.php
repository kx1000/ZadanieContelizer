<?php


namespace App\Utils;


class TextRandomizer
{
    public function randomize(string $text): string
    {
        return preg_replace_callback("/[a-zA-Ząćęłńóśźż]+/ui", function(array $word) {
            return $this->randomizeWord($word[0]);
        }, $text);
    }

    private function randomizeWord(string $word): string
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
        return implode('', $temp[0]);
    }
}