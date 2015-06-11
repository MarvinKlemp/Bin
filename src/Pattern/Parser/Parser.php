<?php

namespace MarvinKlemp\Bin\Pattern\Parser;

use MarvinKlemp\Bin\Binary;
use MarvinKlemp\Bin\Pattern\Lexer\Lexer;
use Symfony\Component\Yaml\Exception\ParseException;

class Parser
{
    /**
     * @var Lexer
     */
    protected $lexer;

    /**
     * @param Lexer $lexer
     */
    public function __construct(Lexer $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * @param  string $pattern
     * @return Binary
     */
    public function parse($pattern)
    {
        $tokens = $this->lexer->tokenize($pattern);
        $binary = new Binary();
        $i = 0;

        while (isset($tokens[$i])) {
            if ($tokens[$i]->type() == "T_WHITESPACE") {
                $i = $i + 1;
                continue;
            }

            if ($tokens[$i]->type() != "T_ID") {
                throw new ParseException(
                    sprintf("unexpected token of type \"%s\", expected: \"T_ID\"", $tokens[$i]->type())
                );
            }

            if ($tokens[$i+1]->type() != "T_PATTERN_SEPARATOR") {
                throw new ParseException(
                    sprintf("unexpected token of type \"%s\", expected: \"T_PATTERN_SEPARATOR\"", $tokens[$i+1]->type())
                );
            }

            if ($tokens[$i+2]->type() != "T_BITCOUNT") {
                throw new ParseException(
                    sprintf("unexpected token of type \"%s\", expected: \"T_BITCOUNT\"", $tokens[$i+2]->type())
                );
            }

            if (isset($tokens[$i+4])) {
                if ($tokens[$i+3]->type() != "T_SEPARATOR") {
                    throw new ParseException(
                        sprintf("unexpected token of type \"%s\", expected: \"T_SEPARATOR\"", $tokens[$i+3]->type())
                    );
                }
            }

            $binary->addField($tokens[$i]->value(), $tokens[$i+2]->value());
            $i = $i + 4;
        }

        return $binary;
    }
}
