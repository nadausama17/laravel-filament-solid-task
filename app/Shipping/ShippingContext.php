<?php

namespace App\Shipping;

readonly class ShippingContext
{
    /**
     * Create a new class instance.
     */

    // constructor property promotion
    public function __construct(public int $weightGrams, public string $country) {}
}
