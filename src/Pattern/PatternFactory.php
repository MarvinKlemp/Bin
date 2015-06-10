<?php

namespace MarvinKlemp\Bin\Pattern;

use MarvinKlemp\Bin\Pattern\Lexer\Lexer;

class PatternFactory
{
    protected $lexer;

    public function __construct(Lexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function fromString($pattern)
    {
        $pattern = $this->lexer->tokenize($pattern);
    }
}
