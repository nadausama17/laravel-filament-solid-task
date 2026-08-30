<?php

namespace App\Contracts;

use App\Shipping\ShippingContext;

interface ShippingMethodInterface
{
    public function calculate(ShippingContext $context): int;
    public function label(): string;
}
