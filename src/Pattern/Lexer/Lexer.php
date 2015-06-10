<?php

namespace MarvinKlemp\Bin\Pattern\Lexer;

class Lexer
{
    protected $tokenMap = array(
        "~,~A" => "T_SEPARATOR",
        "~:~A" => "T_PATTERN_SEPARATOR",
        "~(\s+)~A" => "T_WHITESPACE",
        "~([A-Za-z]+)~A" => "T_ID",
        "~(\d+)~A" => "T_BITCOUNT",
    );

    /**
     * @param  string         $pattern
     * @return Token[]
     * @throws LexerException
     */
    public function tokenize($pattern)
    {
        $tokens = [];

        $offset = 0;
        while (isset($pattern[$offset])) {
            foreach ($this->tokenMap as $regex => $token) {
                if (preg_match($regex, $pattern, $matches, null, $offset)) {
                    $tokens[] = new Token(
                        $token,
                        $matches[0]
                    );
                    $offset += strlen($matches[0]);
                    continue 2;
                }
            }

            throw new LexerException(sprintf('Unexpected character "%s"', $pattern[$offset]));
        }

        return $tokens;
    }
}
