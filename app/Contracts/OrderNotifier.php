<?php

namespace App\Contracts;

use App\Models\Order;

interface OrderNotifier
{
    public function notify(Order $order, string $message): void;
}
