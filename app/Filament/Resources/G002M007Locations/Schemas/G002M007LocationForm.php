<?php

namespace App\Filament\Resources\G002M007Locations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G002M007LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lokasi')
                    ->default(null),
                Select::make('type')
                    ->label('Tipe Lokasi')
                    ->options([
                        'agen' => 'Agen',
                        'toko' => 'Toko',
                    ])
                    ->default(null),
                Select::make('user_id')
                    ->label('Penanggung Jawab')
                    ->relationship('user', 'name')
                    ->default(null),
            ]);
    }
}
