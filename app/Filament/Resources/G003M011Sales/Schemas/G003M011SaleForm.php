<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use App\Models\G001M004Book;
use App\Models\G003M011Sale;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemForm;

class G003M011SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->default(now()),
                Select::make('g002_m007_location_id')
                    ->searchable()
                    ->preload()
                    ->relationship('location', 'name')
                    ->label('Lokasi Penjualan')
                    ->default(auth()->user()->location->id ?? 'Toko'),
                Select::make('user_id')
                    ->searchable()
                    ->preload()
                    ->relationship('seller', 'name')
                    ->label('Dijual Oleh')
                    ->default(auth()->id() ?? null),
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->hidden()
                    ->label('Total Penjualan')
                    ->default(null),
            ]);
    }
}
