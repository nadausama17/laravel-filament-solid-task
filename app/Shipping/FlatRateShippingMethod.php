<?php

namespace App\Shipping;

use App\Contracts\ShippingMethodInterface;
use Override;

class FlatRateShippingMethod implements ShippingMethodInterface
{
    private const RATE = 5000;

    #[Override]
    public function calculate(ShippingContext $context): int
    {
        return self::RATE;
    }
}
