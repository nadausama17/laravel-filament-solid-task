<?php

namespace Tests\Unit\Shipping;

use App\Shipping\FlatRateShippingMethod;
use App\Shipping\ShippingContext;
use PHPUnit\Framework\TestCase;

class FlatRateShippingMethodTest extends TestCase
{
    public function test_flat_rate_always_5000(): void
    {
        $method = new FlatRateShippingMethod();

        $context = new ShippingContext(weightGrams: 1000, country: 'EG');
        $this->assertSame(5000, $method->calculate(context: $context));

        $context = new ShippingContext(weightGrams: 5000, country: 'US');
        $this->assertSame(5000, $method->calculate(context: $context));
    }
}
