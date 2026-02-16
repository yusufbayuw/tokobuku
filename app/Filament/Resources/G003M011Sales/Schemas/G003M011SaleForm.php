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
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Filament\Resources\G003M012SaleItems\Schemas\G003M012SaleItemForm;

class G003M011SaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->disabled(fn($record) => in_array($record?->status, ['final', 'cancelled']))
                    ->default(now()),
                Select::make('status')
                    ->label('Status')
                    ->options(function ($record) {
                        $allOptions = [
                            'draft' => 'Draft',
                            'final' => 'Final',
                            'cancelled' => 'Dibatalkan',
                        ];

                        if ($record?->status === 'final') {
                            // Can only go to Cancelled or stay Final
                            return [
                                'final' => 'Final',
                                'cancelled' => 'Dibatalkan',
                            ];
                        }

                        if ($record?->status === 'cancelled') {
                            // Locked
                            return [
                                'cancelled' => 'Dibatalkan',
                            ];
                        }

                        // Default (Draft or New)
                        return $allOptions;
                    })
                    ->disabled(fn($record) => $record?->status === 'cancelled')
                    ->dehydrated()
                    ->required()
                    ->default('draft'),
                Select::make('g002_m007_location_id')
                    ->searchable()
                    ->preload()
                    ->relationship('location', 'name')
                    ->label('Lokasi Penjualan')
                    ->disabled(fn($record) => (auth()->user()->hasRole('agen')) || in_array($record?->status, ['final', 'cancelled']))
                    ->dehydrated()
                    ->default(auth()->user()->locations->first()?->id ?? 'Toko'),
                Select::make('user_id')
                    ->searchable()
                    ->preload()
                    ->relationship('seller', 'name')
                    ->label('Dijual Oleh')
                    ->disabled(fn($record) => (auth()->user()->hasRole('agen')) || in_array($record?->status, ['final', 'cancelled']))
                    ->dehydrated()
                    ->default(auth()->id() ?? null),
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->disabled(fn($record) => in_array($record?->status, ['final', 'cancelled']))
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->hidden()
                    ->label('Total Penjualan')
                    ->default(null),
            ]);
    }
}
