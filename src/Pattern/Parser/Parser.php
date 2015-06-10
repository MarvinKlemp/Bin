<?php

namespace MarvinKlemp\Bin\Pattern\Parser;

use MarvinKlemp\Bin\Pattern\BinaryPattern;
use Symfony\Component\Yaml\Exception\ParseException;

class Parser
{
    /**
     * @param  array         $tokens
     * @return BinaryPattern
     */
    public function compile(array $tokens)
    {
        $pattern = new BinaryPattern();

        $i = 0;
        while (isset($tokens[$i])) {
            if ($tokens[$i][0] == "T_WHITESPACE") {
                $i = $i + 1;
                continue;
            }

            if ($tokens[$i][0] != "T_ID") {
                throw new ParseException(sprintf("unexpected token of type \"%s\", expected: \"T_ID\"", $tokens[$i][0]));
            }

            if ($tokens[$i+1][0] != "T_PATTERN_SEPARATOR") {
                throw new ParseException(sprintf("unexpected token of type \"%s\", expected: \"T_PATTERN_SEPARATOR\"", $tokens[$i+1][0]));
            }

            if ($tokens[$i+2][0] != "T_BITCOUNT") {
                throw new ParseException(sprintf("unexpected token of type \"%s\", expected: \"T_BITCOUNT\"", $tokens[$i+2][0]));
            }

            if (isset($tokens[$i+4])) {
                if ($tokens[$i+3][0] != "T_SEPARATOR") {
                    throw new ParseException(sprintf("unexpected token of type \"%s\", expected: \"T_SEPARATOR\"", $tokens[$i+3][0]));
                }
            }

            $pattern->addField($tokens[$i][1], $tokens[$i+2][1]);
            $i = $i + 4;
        }

        return $pattern;
    }
}
