<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Truncater;

class TruncaterTest extends TestCase
{
    public function testTrancate()
    {
        $truncater1 = new Truncater();
        $truncater2 = new Truncater(['length' => 8]);
        $this->assertSame("Long...", $truncater1->truncate("Long text", ['length' => 4]));
        $this->assertSame("Long text", $truncater1->truncate("Long text"));
        $this->assertSame(
            "Long .....",
            $truncater2->truncate("Long text", ['length' => 5,'separator' => '.....'])
        );
        $this->assertSame("Long tex...", $truncater2->truncate("Long text"));
    }
}
