<?php

namespace App;

class MaxPriceFilter implements ProductFilteringStrategy
{
    private int $maxPrice;

    public function __construct(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }

    public function filter(array $collection): array
    {
        $filteredProducts = array();
        $price = 0;
        for ($i = 0; $i < count($collection); $i++) {
            if (isset($collection[$i]->discount)) {
                $discount = $collection[$i]->discount;
                $price = $collection[$i]->price * (1 - $discount / 100);
            } else {
                $price = $collection[$i]->price;
            }
            if ($price <= $this->maxPrice) {
                $filteredProducts[] = $collection[$i];
            }
        }

        return $filteredProducts;
    }
}
