<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'weight_grams' => $this->faker->numberBetween(50, 20000),
            'subtotal_minor' => $this->faker->numberBetween(500, 50000),
            'shipping_method' => $this->faker->randomElement(['flat', 'weight', 'zone']),
            'shipping_cost_minor' => $this->faker->optional(0.85)->numberBetween(0, 3000),
            'status' => $this->faker->randomElement(OrderStatus::cases())->value,
        ];
    }
}
