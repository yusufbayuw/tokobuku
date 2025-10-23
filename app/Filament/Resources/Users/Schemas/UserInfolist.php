<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Pengguna')
                    ->tabs([
                        Tabs\Tab::make('Informasi Pengguna')
                            ->icon('heroicon-o-user-circle')
                            ->components([
                                TextEntry::make('name')
                                    ->label('Nama'),
                                TextEntry::make('email')
                                    ->label('Alamat email'),
                                TextEntry::make('username')
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Peran Pengguna')
                            ->icon('heroicon-o-shield-check')
                            ->components([
                                TextEntry::make('roles.name')
                                    ->label('Peran'),
                            ]),
                        Tabs\Tab::make('Keamanan')
                            ->icon('heroicon-o-clock')
                            ->components([
                                TextEntry::make('created_at')
                                    ->label('Dibuat pada')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Diperbarui pada')
                                    ->dateTime()
                                    ->placeholder('-'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
