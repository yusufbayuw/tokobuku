<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Set;

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
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('username')
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(static fn(?string $state): ?string => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(static fn(?string $state): bool => filled($state))
                    ->required(static fn(?object $record): bool => $record === null),
                /* Select::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Pengguna Sebagai')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->required()
                    ->disableOptionWhen(fn (string $value) : bool => (auth()->user()->hasRole('super_admin') ? false : $value === 'super_admin'))
                    ->hidden(!auth()->user()->hasRole(['admin', 'super_admin'])), */
                Select::make('role_helper')
                    ->label('Pengguna Sebagai')
                    ->options(fn () => auth()->user()->hasRole('super_admin') ? [
                        'agen' => 'agen',
                        'admin' => 'admin',
                        'super_admin' => 'super_admin'
                    ] : [
                        'agen' => 'agen',
                        'admin' => 'admin'
                    ])
                    ->required(),
            ]);
    }
}
