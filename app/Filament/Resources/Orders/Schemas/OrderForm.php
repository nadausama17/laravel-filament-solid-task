<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('country')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('weight_grams')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal_minor')
                    ->required()
                    ->numeric(),
                TextInput::make('shipping_method')
                    ->required(),
                TextInput::make('shipping_cost_minor')
                    ->numeric(),
                Select::make('status')
                    ->options(OrderStatus::class)
                    ->default('pending')
                    ->required(),
            ]);
    }
}
