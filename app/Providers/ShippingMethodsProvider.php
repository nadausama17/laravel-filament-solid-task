<?php

namespace App\Providers;

use App\Shipping\FlatRateShippingMethod;
use App\Shipping\ShippingMethodsRegistry;
use App\Shipping\WeightBasedShippingMethod;
use App\Shipping\ZoneBasedShippingMethod;
use Illuminate\Support\ServiceProvider;

class ShippingMethodsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ShippingMethodsRegistry::class, function () {
            $registry = new ShippingMethodsRegistry();

            $registry->register('flat', new FlatRateShippingMethod());
            $registry->register('weight', new WeightBasedShippingMethod());
            $registry->register('zone', new ZoneBasedShippingMethod());

            return $registry;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
