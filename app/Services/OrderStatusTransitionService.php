<?php

namespace App\Services;

use App\Contracts\OrderNotifier;
use App\Enums\OrderStatus;
use App\Models\Order;

class OrderStatusTransitionService
{
    public function __construct(private OrderNotifier $notifier) {}

    public function markAsShipped(Order $order): void
    {
        $order->update(['status' => OrderStatus::Shipped]);

        $this->notifier->notify(order: $order, message: 'has been shipped');
    }
}
