<?php

namespace App\Filament\Resources\G002M009Returns\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class G002M009ReturnForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('from_location_id')
                    ->label('Lokasi Pengirim')
                    ->relationship('fromLocation', 'name')
                    ->default(null),
                Select::make('to_location_id')
                    ->label('Lokasi Penerima')
                    ->relationship('toLocation', 'name')
                    ->default(null),
                Select::make('handled_by')
                    ->label('Ditangani Oleh')
                    ->relationship('handler', 'name')
                    ->default(null),
                DatePicker::make('return_date')
                    ->label('Tanggal Distribusi')
                    ->default(null),
                Textarea::make('note')
                    ->label('Catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
