<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Product;
use App\ProductCollection;
use App\ManufacturerFilter;
use App\MaxPriceFilter;

class FilterTest extends TestCase
{
    public function testMaxPriceFilter()
    {
        $p1 = new Product();
        $p1->name = 'Шоколад';
        $p1->price = 100;
        $p1->discount = 50;
        $p1->manufacturer = 'Красный Октябрь';

        $p2 = new Product();
        $p2->name = 'Мармелад';
        $p2->price = 100;
        $p2->manufacturer = 'Ламзурь';

        $p3 = new Product();
        $p3->name = 'Пряники';
        $p3->price = 50;
        $p3->manufacturer = 'Красный Октябрь';

        $collection = new ProductCollection([$p1, $p2, $p3]);
        $resultCollection = $collection->filter(new MaxPriceFilter(70));
        $this->assertSame(2, count($resultCollection->getProductsArray()));
    }


    public function testManufacturerFilter()
    {
        $p1 = new Product();
        $p1->name = 'Шоколад';
        $p1->price = 100;
        $p1->discount = 50;
        $p1->manufacturer = 'Красный Октябрь';

        $p2 = new Product();
        $p2->name = 'Мармелад';
        $p2->price = 100;
        $p2->manufacturer = 'Ламзурь';

        $p3 = new Product();
        $p3->name = 'Пряники';
        $p3->price = 50;
        $p3->manufacturer = 'Красный Октябрь';

        $collection = new ProductCollection([$p1, $p2, $p3]);
        $resultCollection = $collection->filter(
            new ManufacturerFilter('Красный Октябрь')
        );
        $this->assertSame(2, count($resultCollection->getProductsArray()));
        $this->assertSame(
            'Шоколад',
            $resultCollection->getProductsArray()[0]->name
        );
        $this->assertSame(
            'Пряники',
            $resultCollection->getProductsArray()[1]->name
        );
    }
}
