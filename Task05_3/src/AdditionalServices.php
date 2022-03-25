<?php

namespace App;

abstract class AdditionalServices implements HotelRoom
{
    protected $hotelRoom;

    public function __construct(HotelRoom $hotelRoom)
    {
        $this->hotelRoom = $hotelRoom;
    }

    abstract public function getName();
    abstract public function getPrice();
}
