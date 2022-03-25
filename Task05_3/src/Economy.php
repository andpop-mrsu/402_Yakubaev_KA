<?php

namespace App;

use App\HotelRoom;

class Economy implements HotelRoom
{
    private static float $price = 1000;
    private static string $name = "Эконом";

    public function getName(): string
    {
        return "Класс: " . self::$name;
    }

    public function getPrice(): float
    {
        return self::$price;
    }
}
