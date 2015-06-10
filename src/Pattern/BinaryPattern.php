<?php

namespace MarvinKlemp\Bin\Pattern;

class BinaryPattern
{
    protected $pattern;

    public function __construct()
    {
        $this->pattern = [];
    }

    public function addField($name, $bitCount)
    {
        $this->pattern[] = [$name => $bitCount];
    }
}
