<?php

namespace App\Filament\Resources\G002M008StockBalances\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G002M008StockBalanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g001_m004_book_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('g002_m007_location_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('qty')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
