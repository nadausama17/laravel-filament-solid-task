<?php

namespace Tests\Unit\Shipping;

use App\Shipping\ShippingContext;
use App\Shipping\WeightBasedShippingMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WeightBasedShippingMethodTest extends TestCase
{
    #[DataProvider('weightProvider')]
    public function test_weight_based_method(int $weightGrams, int $expectedCost): void
    {
        $method = new WeightBasedShippingMethod();

        $context = new ShippingContext(weightGrams: $weightGrams, country: 'EG');
        $this->assertSame($expectedCost, $method->calculate($context));
    }

    public static function weightProvider(): array
    {
        return [
            'under 1kg' => [500, 2000],
            'exactly 1kg' => [1000, 2000],
            'above 1kg' => [1001, 2500],
            'exactly 2kg' => [2000, 2500],
            'above 2kg' => [2001, 3000]
        ];
    }
}
