<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Economy;
use App\Standard;
use App\Luxury;
use App\DedicatedInternet;
use App\AdditionalSofa;
use App\FoodDelivery;
use App\Dinner;
use App\BreakfastBuffet;

class DecoratorTest extends TestCase
{
    public function testDecorator()
    {
        $room1 = new Standard();
        $room1 = new FoodDelivery($room1);
        $room1 = new DedicatedInternet($room1);
        $this->assertSame(
            "Класс: Стандарт, доставка еды в номер, выделенный Интернет",
            $room1->getName()
        );
        $this->assertEquals(2400, $room1->getPrice());

        $room2 = new Luxury();
        $room2 = new DedicatedInternet($room2);
        $room2 = new AdditionalSofa($room2);
        $room2 = new BreakfastBuffet($room2);
        $room2 = new Dinner($room2);
        $this->assertSame(
            "Класс: Люкс, выделенный Интернет, дополнительный диван" .
            ", завтрак \"шведский стол\", ужин",
            $room2->getName()
        );
        $this->assertEquals(4900, $room2->getPrice());
    }
}
