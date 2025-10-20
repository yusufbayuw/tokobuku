<?php

namespace App\Filament\Resources\G003M011Sales\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G003M011SaleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Penjualan Buku')
                    ->tabs([
                        Tabs\Tab::make('Detail')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('location.name')
                                    ->label('Lokasi Penjualan')
                                    ->placeholder('-'),
                                TextEntry::make('user.name')
                                    ->label('Dijual Oleh')
                                    ->placeholder('-'),
                                TextEntry::make('customer_name')
                                    ->label('Nama Pelanggan')
                                    ->placeholder('-'),
                                TextEntry::make('total')
                                    ->label('Total Penjualan')
                                    ->numeric()
                                    ->placeholder('-'),
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
