<?php

namespace App\Shipping;

use App\Contracts\ShippingMethodInterface;
use Override;

class WeightBasedShippingMethod implements ShippingMethodInterface
{
    private const BASE = 2000;
    private const EXTRA_KG_COST = 500;
    private const GRAMS_IN_KG = 1000;

    #[Override]
    public function calculate(ShippingContext $context): int
    {
        // get the extra KG to calculate the extra cost after the first KG
        $extraKG = max(0, (int) ceil($context->weightGrams / self::GRAMS_IN_KG) - 1);

        return self::BASE + ($extraKG * self::EXTRA_KG_COST);
    }
}
