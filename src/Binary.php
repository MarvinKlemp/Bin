<?php

namespace MarvinKlemp\Bin;

class Binary
{
    protected $pattern;

    public function __construct()
    {
        $this->pattern = [];
    }

    /**
     * @param string $name
     * @param int $bitCount
     */
    public function addField($name, $bitCount)
    {
        $this->pattern[] = [$name => $bitCount];
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasField($name)
    {
        return ($this->pos($name) === -1) ? false : true;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setField($name, $value)
    {
        if (($pos = $this->pos($name)) === -1) {
            throw new \RuntimeException(sprintf('No such element %s', $name));
        }

        $this->pattern[$pos][$name] = $value;
    }

    /**
     * @param $name
     * @return int
     */
    private function pos($name)
    {
        $i = 0;

        while (isset($this->pattern[$i])) {
            if (isset($this->pattern[$i][$name])) {
                return $i;
            }

            $i++;
        }

        return -1;
    }
}
