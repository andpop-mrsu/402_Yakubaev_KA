<?php

namespace App;

use App\StackInterface;

class Stack implements StackInterface
{
    private array $stack = array();

    public function __construct(...$elem)
    {
        $this->push(...$elem);
    }

    public function push(...$elem): void
    {
        foreach ($elem as $e) {
            array_push($this->stack, $e);
        }
    }

    public function pop(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return array_pop($this->stack);
        }
    }

    public function top(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return $this->stack[count($this->stack) - 1];
        }
    }
    public function isEmpty(): bool
    {
        if (count($this->stack) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function copy(): Stack
    {
        return new Stack(...$this->stack);
    }

    public function __toString(): string
    {
        $string = "[";
        for ($i = count($this->stack) - 1; $i >= 0; $i--) {
            if ($i == 0) {
                $string = $string . $this->stack[$i];
            } else {
                $string = $string . $this->stack[$i] . "->";
            }
        }
        $string .= "]";
        return $string;
    }
}
