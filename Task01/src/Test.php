<?php
namespace App\Test;

use App\Vector;

function runTest() {
    // String representation test
    $v1 = new Vector(1, 2, 3);
    echo $v1."\n";

    // Adding test
    $v2 = new Vector(1, 4, -2);
    $v3 = $v1->add($v2);
    echo $v3."\n";

    //Subtracting test
    $v4 = $v1->sub($v2);
    echo $v4."\n";

    //Product test
    $number1 = 2;
    $v5 = $v4->product($number1);
    echo $v5."\n";

    //Scalar product test
    $number2 = $v4->scalarProduct($v5);
    echo $number2."\n";

    //Vector product test
    $v7 = $v2->vectorProduct($v1);
    echo $v7."\n";
}