<?php

namespace App;

use App\QueueInterface;

class Queue implements QueueInterface
{
    private $queue = array();

    public function __construct(mixed ...$elem)
    {
        $this->enqueue(...$elem);
    }

    public function enqueue(mixed ...$elem): void
    {
        foreach ($elem as $e) {
            array_push($this->queue, $e);
        }
    }

    public function dequeue(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return array_shift($this->queue);
        }
    }

    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return $this->queue[0];
        }
    }

    public function isEmpty(): bool
    {
        if (count($this->queue) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function copy(): Queue
    {
        return new Queue(...$this->queue);
    }

    public function __toString(): string
    {
        $string = "[";
        for ($i = 0; $i < count($this->queue); $i++) {
            if ($i == count($this->queue) - 1) {
                $string = $string . $this->queue[$i];
            } else {
                $string = $string . $this->queue[$i] . "<-";
            }
        }
        $string .= "]";
        return $string;
    }
}
