<?php

namespace App;

use App\HotelRoom;
use App\AdditionalServices;

class BreakfastBuffet extends AdditionalServices
{
    private static float $price = 500;

    public function getName(): string
    {
        return $this->hotelRoom->getName() . ", завтрак \"шведский стол\"";
    }

    public function getPrice(): float
    {
        return $this->hotelRoom->getPrice() + self::$price;
    }
}
