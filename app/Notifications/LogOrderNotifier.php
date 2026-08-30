<?php

namespace App\Notifications;

use App\Contracts\OrderNotifier;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Override;

class LogOrderNotifier implements OrderNotifier
{
    #[Override]
    public function notify(Order $order, string $message): void
    {
        Log::info("Order #{$order->id}: {$message}");
    }
}
