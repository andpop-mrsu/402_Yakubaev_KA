<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Queue;

class QueueTest extends TestCase
{
    public function testEnqueueAndEmpty()
    {
        $queue = new Queue();
        $this->assertEquals(true, $queue->isEmpty());
        $queue->enqueue(1);
        $this->assertEquals(false, $queue->isEmpty());
    }

    public function testDequeue()
    {
        $queue = new Queue(1, true, "string");
        $this->assertEquals(1, $queue->dequeue());
        $this->assertEquals(true, $queue->dequeue());
        $this->assertEquals("string", $queue->dequeue());
        $this->assertEquals(null, $queue->dequeue());
    }

    public function testPeek()
    {
        $queue = new Queue(1, true, "string");
        $this->assertEquals(1, $queue->peek());
    }

    public function testCopy()
    {
        $queue1 = new Queue("qwerty", 33, 99, "tests402", 65);
        $queue2 = $queue1->copy();
        $this->assertEquals($queue1->__toString(), $queue2->__toString());
    }

    public function testString()
    {
        $queue = new Queue();
        $this->assertEquals("[]", $queue->__toString());
        $queue->enqueue(1, 2, 3, 4, 5);
        $this->assertEquals("[1<-2<-3<-4<-5]", $queue->__toString());
    }
}
