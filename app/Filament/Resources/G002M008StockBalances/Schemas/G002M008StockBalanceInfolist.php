<?php

namespace App\Filament\Resources\G002M008StockBalances\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G002M008StockBalanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Detail')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('book.title')
                                    ->label('Judul Buku')
                                    ->placeholder('-'),
                                TextEntry::make('location.name')
                                    ->label('Lokasi Buku')
                                    ->placeholder('-'),
                                TextEntry::make('qty')
                                    ->label('Kuantitas')
                                    ->numeric()
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
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
