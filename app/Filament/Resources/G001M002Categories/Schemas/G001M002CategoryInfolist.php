<?php

namespace App\Filament\Resources\G001M002Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G001M002CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Category Details')
                    ->tabs([
                        Tabs\Tab::make('Detail Kategori')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('name')
                                    ->label('Nama Kategori')
                                    ->placeholder('-'),
                                TextEntry::make('description')
                                    ->label('Deskripsi')
                                    ->placeholder('-'),
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
