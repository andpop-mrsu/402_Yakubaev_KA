<?php

namespace Tests\VectorTest;

use App\Vector;

use PHPUnit\Framework\TestCase;

class VectorTest extends TestCase
{
    public function testAdd()
    {
        $v1 = new Vector(1, 2, 3);
        $v2 = new Vector(3, 2, 1);
        $this->assertEquals(new Vector(4, 4, 4), $v1->add($v2));
    }

    public function testSub()
    {
        $v1 = new Vector(4, 5, 6);
        $v2 = new Vector(7, 8, 9);
        $this->assertEquals(
            new Vector(-3, -3, -3), 
            $v1->sub($v2)
        );
    }

    public function testProduct()
    {
        $v1 = new Vector(10, 11, 12);
        $this->assertEquals(
            new Vector(20, 22, 24), 
            $v1->product(2)
        );
    }

    public function testScalarProduct()
    {
        $v1 = new Vector(1, 4, 1);
        $v2 = new Vector(6, 7, 8);
        $this->assertEquals(42, $v1->scalarProduct($v2));
    }

    public function testVectorProduct()
    {
        $v1 = new Vector(13, 14, 15);
        $v2 = new Vector(16, 17, 18);
        $this->assertEquals(
            new Vector(-3, 6, -3), 
            $v1->vectorProduct($v2)
        );
    }
}
