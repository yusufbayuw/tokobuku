<?php

namespace App\Filament\Resources\G003M012SaleItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G003M012SaleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g003_m011_sale_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('g001_m004_book_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('unit_price')
                    ->numeric()
                    ->default(null),
                TextInput::make('qty')
                    ->numeric()
                    ->default(null),
                TextInput::make('subtotal')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
