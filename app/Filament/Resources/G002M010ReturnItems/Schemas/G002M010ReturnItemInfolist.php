<?php

namespace App\Filament\Resources\G002M010ReturnItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G002M010ReturnItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Item Distribusi Buku')
                    ->tabs([
                        Tabs\Tab::make('Detail')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('book.title')
                                    ->label('Buku')
                                    ->placeholder('-'),
                                TextEntry::make('qty')
                                    ->label('Jumlah Buku')
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Distribusi Buku')
                            ->icon('heroicon-o-book-open')
                            ->components([
                                TextEntry::make('retur.fromLocation.name')
                                    ->label('Dari lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('retur.toLocation.name')
                                    ->label('Ke lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('returhandler.name')
                                    ->label('Ditangani Oleh')
                                    ->placeholder('-'),
                                TextEntry::make('retur.return_date')
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
                                    ->label('Tanggal Dibuat')
                                    ->dateTime('d F Y H:i:s')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Tanggal Diperbarui')
                                    ->dateTime('d F Y H:i:s')
                                    ->placeholder('-'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
