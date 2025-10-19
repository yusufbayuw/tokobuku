<?php

namespace App\Filament\Resources\G001M003Publishers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class G001M003PublisherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Penerbit')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email Penerbit')
                    ->email()
                    ->default(null),
                TextInput::make('phone')
                    ->label('Telepon Penerbit')
                    ->numeric()
                    ->default(null),
                Textarea::make('address')
                    ->label('Alamat')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
