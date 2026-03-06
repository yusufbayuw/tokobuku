<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use App\Models\G001M004Book;
use App\Models\G003M011Sale;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\DateTimePicker;
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
                    ->live()
                    ->dehydrated()
                    ->required()
                    ->default('draft'),
                Select::make('user_id')
                    ->searchable()
                    ->preload()
                    ->relationship('seller', 'name')
                    ->label('Dijual Oleh')
                    ->disabled(fn($record) => auth()->user()->hasRole('agen') || in_array($record?->status, ['final', 'cancelled']))
                    ->dehydrated()
                    ->default(auth()->id() ?? null)
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('g002_m007_location_id', null)),
                Select::make('g002_m007_location_id')
                    ->searchable()
                    ->preload()
                    ->relationship(
                        name: 'location',
                        titleAttribute: 'name',
                        modifyQueryUsing: function (\Illuminate\Database\Eloquent\Builder $query, Get $get) {
                            $userId = $get('user_id');
                            if ($userId) {
                                return $query->where('user_id', $userId);
                            }
                            if (auth()->user()->hasRole('agen')) {
                                return $query->where('user_id', auth()->id());
                            }
                            return $query;
                        }
                    )
                    ->label('Lokasi Penjualan')
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        if ($state) {
                            session(['last_location_id' => $state]);
                        }
                    })
                    ->disabled(
                        fn($record) =>
                        (auth()->user()->hasRole('agen') && auth()->user()->locations->count() <= 1) ||
                        in_array($record?->status, ['final', 'cancelled']) ||
                        ($record && $record->items()->exists())
                    )
                    ->dehydrated()
                    ->default(function (Get $get) {
                        $userId = $get('user_id') ?? auth()->id();
                        $user = \App\Models\User::with('locations')->find($userId);
                        if ($user && $user->locations->count() === 1) {
                            return $user->locations->first()->id;
                        }
                        return session('last_location_id') ?? $user?->locations->first()?->id ?? null;
                    }),
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->disabled(fn($record) => in_array($record?->status, ['final', 'cancelled']))
                    ->default(null),
                TextInput::make('total')
                    ->numeric()
                    ->hidden()
                    ->label('Total Penjualan')
                    ->dehydrated(false)
                    ->default(null),
            ]);
    }
}
