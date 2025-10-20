<?php

namespace App\Filament\Resources\G003M012SaleItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G003M012SaleItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Buku Terjual')
                    ->tabs([
                        Tabs\Tab::make('Informasi Umum')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('sale.location.name')
                                    ->label('Lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('book.title')
                                    ->label('Judul Buku')
                                    ->placeholder('-'),
                                TextEntry::make('unit_price')
                                    ->label('Harga Satuan')
                                    ->placeholder('-'),
                                TextEntry::make('qty')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Riwayat')
                            ->icon('heroicon-o-clock')
                            ->components([
                                TextEntry::make('created_at')
                                    ->label('Tanggal Dibuat')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Tanggal Diperbarui')
                                    ->dateTime()
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}
