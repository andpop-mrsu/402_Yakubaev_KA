<?php
namespace App;

class Vector
{
    private $x;
    private $y;
    private $z;

    public function __construct(int $x, int $y, int $z) 
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function add(Vector $vector) : Vector
    {
        $x = $this->x + $vector->x;
        $y = $this->y + $vector->y;
        $z = $this->z + $vector->z; 
        return new Vector($x, $y, $z);
    }

    public function sub(Vector $vector) : Vector
    {
        $x = $this->x - $vector->x;
        $y = $this->y - $vector->y;
        $z = $this->z - $vector->z; 
        return new Vector($x, $y, $z);
    }

    public function product(int $number) : Vector
    {
        $x = $this->x * $number;
        $y = $this->y * $number;
        $z = $this->z * $number; 
        return new Vector($x, $y, $z);
    }

    public function scalarProduct(Vector $vector) : int
    {
        $aLength = sqrt(
            pow($this->x, 2) + 
            pow($this->y, 2) + 
            pow($this->z, 2)
        );
    
        $bLength = sqrt(
            pow($vector->x, 2) + 
            pow($vector->y, 2) + 
            pow($vector->z, 2)
        );

        $cosAB = (
            $this->x * $vector->x + 
            $this->y * $vector->y + 
            $this->z * $vector->z
        ) / ($aLength * $bLength);
        return $aLength * $bLength * $cosAB;
    }

    public function vectorProduct(Vector $vector) : Vector
    {
        $x = $this->y * $vector->z - $this->z * $vector->y;
        $y = $this->z * $vector->x - $this->x * $vector->z;
        $z = $this->x * $vector->y - $this->y * $vector->x;  
        return new Vector($x, $y, $z);
    }

    public function __toString() : string
    {
        return "(" . $this->x . ";" . $this->y . ";" . $this->z . ")";
    }
}