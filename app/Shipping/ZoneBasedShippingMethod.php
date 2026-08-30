<?php

namespace App\Shipping;

use App\Contracts\ShippingMethodInterface;
use Override;

class ZoneBasedShippingMethod implements ShippingMethodInterface
{
    private const DEFAULT_COUNTRY_RATE = 15000;

    private const COUNTRY_MAP = [
        'EG' => 3000,
        'SA' => 8000,
        'AE' => 8000
    ];

    #[Override]
    public function calculate(ShippingContext $context): int
    {
        return self::COUNTRY_MAP[$context->country] ?? self::DEFAULT_COUNTRY_RATE;
    }

    #[Override]
    public function label(): string
    {
        return 'Zone Based';
    }
}
