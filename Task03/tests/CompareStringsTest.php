<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function App\compareStrings;

class CompareStringsTest extends TestCase
{
    public function testCompareStrings() 
    {
        $this->assertSame(true, compareStrings("ab#c", "ade##c"));
        $this->assertEquals(false, compareStrings("a#c", "c#"));
        $this->assertEquals(true, compareStrings("abc###", "a#b#"));
    }
}
