<?php

namespace Tests\Unit\Shipping;

use App\Shipping\ShippingContext;
use App\Shipping\ZoneBasedShippingMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ZoneBasedShippingMethodTest extends TestCase
{
    #[DataProvider('zoneProvider')]
    public function test_zone_based_method(string $country, int $expectedCost): void
    {
        $method = new ZoneBasedShippingMethod();

        $context = new ShippingContext(weightGrams: 5000, country: $country);
        $this->assertSame($expectedCost, $method->calculate($context));
    }

    public static function zoneProvider(): array
    {
        return [
            'Egypt' => ['EG', 3000],
            'Saudi Arabia' => ['SA', 8000],
            'UAE' => ['AE', 8000],
            'USA' => ['US', 15000]
        ];
    }
}
