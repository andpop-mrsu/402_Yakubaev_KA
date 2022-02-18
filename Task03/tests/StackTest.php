<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Stack;

class StackTest extends TestCase
{
    public function testPush()
    {
        $stack = new Stack();
        $this->assertEquals(true, $stack->isEmpty());
        $stack->push(1);
        $this->assertEquals(false, $stack->isEmpty());
    }

    public function testPop()
    {
        $stack = new Stack(1, true, "string");
        $this->assertEquals("string", $stack->pop());
        $this->assertEquals(true, $stack->pop());
        $this->assertEquals(1, $stack->pop());
        $this->assertEquals(null, $stack->pop());
    }

    public function testTop()
    {
        $stack1 = new Stack(1, true, "string");
        $stack2 = new Stack();
        $this->assertEquals("string", $stack1->top());
        $this->assertEquals(null, $stack2->top());
    }

    public function testEmpty()
    {
        $stack = new Stack();
        $this->assertEquals(true, $stack->isEmpty());
        $stack->push(1);
        $this->assertEquals(false, $stack->isEmpty());
    }

    public function testCopy()
    {
        $stack1 = new Stack(5, 1, 62, 46, "345fdfdfd", 43);
        $stack2 = $stack1->copy();
        $this->assertEquals($stack1->__toString(), $stack2->__toString());
    }

    public function testString()
    {
        $stack = new Stack();
        $this->assertEquals("[]", $stack->__toString());
        $stack->push(1, 2, 3, 4, 5);
        $this->assertEquals("[5->4->3->2->1]", $stack->__toString());
    }
}
