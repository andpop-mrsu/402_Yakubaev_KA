<?php

namespace App;

class ManufacturerFilter implements ProductFilteringStrategy
{
    private string $manufacturer;

    public function __construct(string $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function filter(array $collection): array
    {
        $filteredProducts = array();
        for ($i = 0; $i < count($collection); $i++) {
            if ($collection[$i]->manufacturer == $this->manufacturer) {
                $filteredProducts[] = $collection[$i];
            }
        }
        return $filteredProducts;
    }
}
