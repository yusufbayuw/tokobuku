<?php

namespace App\Filament\Resources\G001M003Publishers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G001M003PublisherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Publisher Details')
                    ->tabs([
                        Tabs\Tab::make('Detail Penerbit')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('name')
                                    ->label('Nama Penerbit')
                                    ->placeholder('-'),
                                TextEntry::make('email')
                                    ->label('Email Penerbit')
                                    ->placeholder('-'),
                                TextEntry::make('phone')
                                    ->label('Telepon Penerbit')
                                    ->placeholder('-'),
                                TextEntry::make('address')
                                    ->label('Alamat')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                TextEntry::make('description')
                                    ->label('Deskripsi')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Riwayat')
                            ->icon('heroicon-o-clock')
                            ->components([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}
