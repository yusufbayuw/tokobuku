<?php

namespace App\Filament\Resources\G002M007Locations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G002M007LocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Location Details')
                    ->tabs([
                        Tabs\Tab::make('Detail Lokasi')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('name')
                                    ->label('Nama Lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('type')
                                    ->label('Tipe Lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('user.name')
                                    ->label('Penanggung Jawab')
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Riwayat')
                            ->icon('heroicon-o-clock')
                            ->components([
                                TextEntry::make('created_at')
                                    ->label('Tanggal Dibuat')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Tanggal Diperbarui')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                    ])->columnSpanFull(),
            ])
        ]);
    }
}
