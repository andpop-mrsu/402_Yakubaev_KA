<?php

namespace App;

use App\PaymentAdapterInterface;
use App\PayPal;

class PayPalAdapter implements PaymentAdapterInterface
{
    private $adaptee;

    public function __construct(PayPal $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function collectMoney($amount): string
    {
        return $this->adaptee->authorizeTransaction();
    }
}
