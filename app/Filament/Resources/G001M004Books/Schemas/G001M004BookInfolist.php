<?php

namespace App\Filament\Resources\G001M004Books\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class G001M004BookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Book Details')
                    ->tabs([
                        Tabs\Tab::make('Detail Buku')
                            ->icon('heroicon-o-information-circle')
                            ->components([
                                TextEntry::make('authors.name')
                                    ->label('Penulis Buku')
                                    ->placeholder('-'),
                                TextEntry::make('publisher.name')
                                    ->label('Penerbit Buku')
                                    ->placeholder('-'),
                                TextEntry::make('categories_list')
                                    ->label('Kategori Buku')
                                    ->placeholder('-'),
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
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('subtitle')
                    ->placeholder('-'),
                TextEntry::make('sku')
                    ->label('SKU')
                    ->placeholder('-'),
                TextEntry::make('g001_m003_publisher_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('edition')
                    ->placeholder('-'),
                TextEntry::make('year')
                    ->placeholder('-'),
                TextEntry::make('language')
                    ->placeholder('-'),
                TextEntry::make('pages')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('cover_photo')
                    ->placeholder('-'),
                TextEntry::make('retail_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('agent_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('min_stock')
                    ->numeric()
                    ->placeholder('-'),
                IconEntry::make('active')
                    ->boolean()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
