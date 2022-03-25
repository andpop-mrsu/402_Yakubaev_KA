<?php

namespace App;

class Luxury implements HotelRoom
{
    private static float $price = 3000;
    private static string $name = "Люкс";

    public function getName(): string
    {
        return "Класс: " . self::$name;
    }

    public function getPrice(): float
    {
        return self::$price;
    }
}
