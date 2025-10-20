<?php

namespace App\Filament\Resources\G002M008StockBalances\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G002M008StockBalanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('g001_m004_book_id')
                    ->label('Judul Buku')
                    ->searchable()
                    ->preload()
                    ->relationship('book', 'title')
                    ->required(),
                Select::make('g002_m007_location_id')
                    ->label('Lokasi Buku')
                    ->searchable()
                    ->preload()
                    ->relationship('location', 'name')
                    ->required(),
                TextInput::make('qty')
                    ->label('Kuantitas')
                    ->numeric()
                    ->minValue(0)
                    ->default(null),
            ]);
    }
}
