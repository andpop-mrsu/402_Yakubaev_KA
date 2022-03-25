<?php

namespace App;

use App\HotelRoom;
use App\AdditionalServices;

class FoodDelivery extends AdditionalServices
{
    private static float $price = 300;

    public function getName(): string
    {
        return $this->hotelRoom->getName() . ", доставка еды в номер";
    }

    public function getPrice(): float
    {
        return $this->hotelRoom->getPrice() + self::$price;
    }
}
