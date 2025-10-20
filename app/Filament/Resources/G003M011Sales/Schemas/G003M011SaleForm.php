<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G003M011SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('g002_m007_location_id')
                    ->relationship('location', 'name')
                    ->label('Lokasi Penjualan')
                    ->default(null),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Dijual Oleh')
                    ->default(null),
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->label('Total Penjualan')
                    ->default(null),
            ]);
    }
}
