<?php

namespace Tests\Feature\Filament;

use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkAsShippedActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_mark_as_shipped(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['status' => OrderStatus::Paid]);

        Livewire::actingAs($user)
            ->test(ListOrders::class)
            ->callTableAction('markAsShipped', $order);

        $this->assertSame(OrderStatus::Shipped, $order->refresh()->status);
    }
}
