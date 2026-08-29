<?php

namespace Tests\Unit\Shipping;

use App\Shipping\PickupShippingMethod;
use App\Shipping\ShippingContext;
use PHPUnit\Framework\TestCase;

class PickupShippingMethodTest extends TestCase
{
    public function test_pickup_method(): void
    {
        $method = new PickupShippingMethod();

        $context = new ShippingContext(weightGrams: 5000, country: 'EG');
        $this->assertSame(0, $method->calculate($context));
    }
}
