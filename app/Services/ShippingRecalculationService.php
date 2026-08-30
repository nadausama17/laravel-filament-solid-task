<?php

namespace App\Services;

use App\Models\Order;
use App\Shipping\ShippingContext;
use App\Shipping\ShippingMethodsRegistry;

class ShippingRecalculationService
{
    public function __construct(private ShippingMethodsRegistry $registry) {}

    public function recalculate(Order $order):int{
        $context = new ShippingContext(
            weightGrams: $order->weight_grams,
            country: $order->country
        );

        $cost = $this->registry->get($order->shipping_method)->calculate($context);

        $order->update(['shipping_cost_minor' => $cost]);

        return $cost;
    }
}
