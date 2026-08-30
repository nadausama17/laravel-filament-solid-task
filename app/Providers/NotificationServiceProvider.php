<?php

namespace App\Providers;

use App\Contracts\OrderNotifier;
use App\Notifications\LogOrderNotifier;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderNotifier::class, LogOrderNotifier::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
