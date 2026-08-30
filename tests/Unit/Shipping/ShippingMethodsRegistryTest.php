<?php

namespace Tests\Unit\Shipping;

use App\Shipping\FlatRateShippingMethod;
use App\Shipping\ShippingMethodsRegistry;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ShippingMethodsRegistryTest extends TestCase
{
    public function test_shipping_methods_registry(): void
    {
        $registry = new ShippingMethodsRegistry();

        $registry->register('flat',new FlatRateShippingMethod());
        $this->assertInstanceOf(FlatRateShippingMethod::class, $registry->get('flat'));
    }

    public function test_exception_wrong_key_registry(): void{
        $registry = new ShippingMethodsRegistry();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Wrong Shipping Method: ship');

        $registry->get('ship');
    }
}
