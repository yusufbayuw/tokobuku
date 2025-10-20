<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('username')
                    ->default(null),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->hidden(!auth()->user()->hasRole(['admin', 'super_admin'])),
            ]);
    }
}
