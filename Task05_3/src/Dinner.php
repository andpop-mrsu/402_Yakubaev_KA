<?php

namespace App;

use App\HotelRoom;
use App\AdditionalServices;

class Dinner extends AdditionalServices
{
    private static float $price = 800;

    public function getName(): string
    {
        return $this->hotelRoom->getName() . ", ужин";
    }

    public function getPrice(): float
    {
        return $this->hotelRoom->getPrice() + self::$price;
    }
}
