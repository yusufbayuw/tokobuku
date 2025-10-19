<?php

namespace App\Filament\Resources\G001M001Authors\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G001M001AuthorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Penulis')
                    ->tabs([
                        Tabs\Tab::make('Detail Penulis')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama Penulis')
                                    ->placeholder('-'),
                                TextEntry::make('bio')
                                    ->label('Deskripsi')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                ImageEntry::make('photo')
                                    ->label('Foto')
                                    ->hidden()
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Riwayat')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d M Y H:i:s')
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
