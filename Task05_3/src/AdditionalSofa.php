<?php

namespace App;

use App\HotelRoom;
use App\AdditionalServices;

class AdditionalSofa extends AdditionalServices
{
    private static float $price = 500;

    public function getName(): string
    {
        return $this->hotelRoom->getName() . ", дополнительный диван";
    }

    public function getPrice(): float
    {
        return $this->hotelRoom->getPrice() + self::$price;
    }
}
