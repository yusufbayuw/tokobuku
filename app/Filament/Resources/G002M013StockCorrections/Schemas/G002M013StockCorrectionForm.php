<?php

namespace App\Filament\Resources\G002M013StockCorrections\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class G002M013StockCorrectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('g002_m008_stock_balance_id')
                    ->default(function ($livewire) {
                        return $livewire->ownerRecord?->id;
                    }),
                Toggle::make('substraction')
                    ->onColor('danger')
                    ->offColor('success')
                    ->onIcon(Heroicon::OutlinedMinus)
                    ->offIcon(Heroicon::OutlinedPlus)
                    ->label(function ($state) {
                        return $state ? 'Pengurangan' : 'Penambahan';
                    })
                    ->live()
                    ->required(),
                TextInput::make('qty')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('note')
                    ->label('Catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
