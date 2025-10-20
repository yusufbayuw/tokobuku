<?php

namespace App\Filament\Resources\G002M010ReturnItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class G002M010ReturnItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('g002_m009_return_id')
                    ->label('Distribusi Buku')
                    ->relationship('return', 'id')
                    ->default(null),
                Select::make('g001_m004_book_id')
                    ->label('Buku')
                    ->relationship('book', 'title')
                    ->default(null),
                TextInput::make('qty')
                    ->label('Jumlah')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
