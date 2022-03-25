<?php

namespace App;

class Standard implements HotelRoom
{
    private static float $price = 2000;
    private static string $name = "Стандарт";

    public function getName(): string
    {
        return "Класс: " . self::$name;
    }

    public function getPrice(): float
    {
        return self::$price;
    }
}
