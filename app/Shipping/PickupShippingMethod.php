<?php

namespace App\Shipping;

use App\Contracts\ShippingMethodInterface;
use Override;

class PickupShippingMethod implements ShippingMethodInterface
{
    #[Override]
    public function calculate(ShippingContext $context): int
    {
        return 0;
    }
}
