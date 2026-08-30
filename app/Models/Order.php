<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'country',
        'city',
        'weight_grams',
        'subtotal_minor',
        'shipping_method',
        'shipping_cost_minor',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'weight_grams' => 'integer',
            'subtotal_minor' => 'integer',
            'shipping_cost_minor' => 'integer',
            'status' => OrderStatus::class,
        ];
    }

    protected function orderTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => "Order #{$this->id}",
        );
    }
}
