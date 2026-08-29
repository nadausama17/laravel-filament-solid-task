<?php

namespace App\Shipping;

use App\Contracts\ShippingMethodInterface;
use InvalidArgumentException;

class ShippingMethodsRegistry
{
    private array $methods = [];

    public function register(string $key, ShippingMethodInterface $method): void
    {
        $this->methods[$key] = $method;
    }

    public function get(string $key): ShippingMethodInterface
    {
        if (!isset($this->methods[$key])) {
            throw new InvalidArgumentException("Wrong Shipping Method: {$key}");
        }

        return $this->methods[$key];
    }
}
