<?php

namespace App;

use App\HotelRoom;
use App\AdditionalServices;

class DedicatedInternet extends AdditionalServices
{
    private static float $price = 100;

    public function getName(): string
    {
        return $this->hotelRoom->getName() . ", выделенный Интернет";
    }

    public function getPrice(): float
    {
        return $this->hotelRoom->getPrice() + self::$price;
    }
}
