<?php

namespace MarvinKlemp\Bin;

use MarvinKlemp\Bin\Pattern\Parser\Parser;

class BinaryFactory
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $pattern
     * @return Binary
     */
    public function fromString($pattern)
    {
        return $this->parser->parse($pattern);
    }
}
