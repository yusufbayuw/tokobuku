<?php

namespace App\Filament\Resources\G002M009Returns\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G002M009ReturnInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Distribusi Buku')
                    ->tabs([
                        Tabs\Tab::make('Detail')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('fromLocation.name')
                                    ->label('Dari lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('toLocation.name')
                                    ->label('Ke lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('handler.name')
                                    ->label('Ditangani Oleh')
                                    ->placeholder('-'),
                                TextEntry::make('return_date')
                                    ->label('Tanggal Distribusi')
                                    ->date('d F Y')
                                    ->placeholder('-'),
                                TextEntry::make('note')
                                    ->label('Catatan')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Riwayat')
                            ->icon('heroicon-o-clock')
                            ->components([
                                TextEntry::make('created_at')
                                    ->dateTime('d F Y H:i:s')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->dateTime('d F Y H:i:s')
                                    ->placeholder('-'),
                            ]),
                    ]),

            ]);
    }
}
