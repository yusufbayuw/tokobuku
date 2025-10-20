<?php

namespace App\Filament\Resources\G003M012SaleItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G003M012SaleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('g003_m011_sale_id')
                    ->label('ID Penjualan')
                    ->numeric()
                    ->default(null),
                Select::make('g001_m004_book_id')
                    ->label('Judul Buku')
                    ->relationship('book', 'title')
                    ->default(null),
                TextInput::make('unit_price')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->default(null),
                TextInput::make('qty')
                    ->label('Jumlah')
                    ->numeric()
                    ->default(null),
                TextInput::make('subtotal')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
