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
                                TextEntry::make('title')
                                    ->label('Judul Buku')
                                    ->placeholder('-'),
                                TextEntry::make('subtitle')
                                    ->label('Subjudul Buku')
                                    ->placeholder('-'),
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
                        Tabs\Tab::make('Informasi Tambahan')
                            ->icon('heroicon-o-document-text')
                            ->components([
                                IconEntry::make('sku')
                                    ->label('SKU')
                                    ->placeholder('-'),
                                TextEntry::make('isbn')
                                    ->label('ISBN')
                                    ->placeholder('-'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->placeholder('-'),
                                TextEntry::make('edition')
                                    ->label('Edisi Buku')
                                    ->placeholder('-'),
                                TextEntry::make('language')
                                    ->label('Bahasa Buku')
                                    ->placeholder('-'),
                                TextEntry::make('pages')
                                    ->label('Jumlah Halaman')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('cover_photo')
                                    ->label('Sampul Buku')
                                    ->placeholder('-'),
                                IconEntry::make('active')
                                    ->boolean()
                                    ->hidden()
                                    ->placeholder('-'),
                            ]),
                        Tabs\Tab::make('Harga')
                            ->icon('heroicon-o-currency-dollar')
                            ->components([
                                TextEntry::make('retail_price')
                                    ->label('Harga Toko')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('agent_price')
                                    ->label('Harga Agen')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('min_stock')
                                    ->label('Minimum Stok')
                                    ->numeric()
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
                    ])->columnSpanFull(),
            ]);
    }
}
