<?php

namespace App;

interface QueueInterface
{
    public function enqueue(mixed ...$elem);
    public function dequeue();
    public function peek();
    public function isEmpty();
    public function copy();
    public function __toString();
}
