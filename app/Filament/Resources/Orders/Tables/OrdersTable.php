<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\OrderStatusTransitionService;
use App\Services\ShippingRecalculationService;
use App\Shipping\ShippingMethodsRegistry;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->searchable(),
                TextColumn::make('country')
                    ->searchable(),
                TextColumn::make('weight_grams')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subtotal_minor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_cost_minor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_method')
                    ->formatStateUsing(fn(string $state, ShippingMethodsRegistry $registry) => $registry->get($state)->label())
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(OrderStatus $state) => $state->color())
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(OrderStatus::class),
                SelectFilter::make('shipping_method')
                    ->options(fn(ShippingMethodsRegistry $registry) => collect($registry->keys())
                        ->mapWithKeys(fn(string $key) => [$key => $registry->get($key)->label()])
                        ->toArray()),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('recalculateShipping')
                    ->label('Recalculate shipping')
                    ->action(function (Order $order, ShippingRecalculationService $service) {
                        $cost = $service->recalculate($order);

                        Notification::make()
                            ->title('Shipping Recalculated')
                            ->body("New shipping cost: {$cost}")
                            ->success()
                            ->send();
                    }),
                Action::make('markAsShipped')
                    ->label('Mark as shipped')
                    ->visible(fn(Order $order) => $order->status === OrderStatus::Paid)
                    ->action(function (Order $order, OrderStatusTransitionService $transition) {
                        $transition->markAsShipped($order);
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
