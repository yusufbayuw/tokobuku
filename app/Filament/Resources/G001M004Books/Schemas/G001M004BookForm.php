<?php

namespace App\Filament\Resources\G001M004Books\Schemas;

use App\Filament\Resources\G001M001Authors\Schemas\G001M001AuthorForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class G001M004BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Buku')
                    ->description('Informasi detail mengenai buku')
                    ->icon('heroicon-o-book-open')
                    ->components([
                        TextInput::make('title')
                            ->label('Judul Buku')
                            ->default(null),
                        TextInput::make('subtitle')
                            ->label('Sub Judul')
                            ->default(null),
                        TextInput::make('sku')
                            ->label('SKU')
                            ->default(null),
                        TextInput::make('isbn')
                            ->label('ISBN')
                            ->default(null),
                        TextInput::make('edition')
                            ->label('Edisi')
                            ->default(null),
                        TextInput::make('language')
                            ->label('Bahasa')
                            ->default(null),
                        TextInput::make('pages')
                            ->label('Jumlah Halaman')
                            ->numeric()
                            ->default(null),
                        FileUpload::make('cover_photo')
                            ->hidden()
                            ->image()
                            ->label('Foto Sampul'),
                    ]),
                Section::make('Penulis, Penerbit dan Kategori')
                    ->description('Informasi mengenai penulis, penerbit dan kategori buku')
                    ->icon('heroicon-o-building-library')
                    ->components([
                        Select::make('authors')
                            ->multiple()
                            ->relationship(titleAttribute: 'name')
                            ->preload()
                            ->label('Penulis Buku')
                            ->createOptionForm(
                                G001M001AuthorForm::configure(Schema::make())->getComponents()
                            ),
                        Select::make('g001_m003_publisher_id')
                            ->relationship('publisher', titleAttribute: 'name')
                            ->preload()
                            ->label('Penerbit')
                            ->default(null),
                        TextInput::make('year')
                            ->label('Tahun Terbit')
                            ->numeric()
                            ->default(null),
                        Select::make('categories')
                            ->multiple()
                            ->relationship(titleAttribute: 'name')
                            ->preload()
                            ->label('Kategori Buku'),
                    ]),
                Section::make('Informasi Harga dan Stok')
                    ->description('Detail mengenai harga dan stok minimal buku')
                    ->icon('heroicon-o-currency-dollar')
                    ->components([
                        TextInput::make('retail_price')
                            ->label('Harga Toko')
                            ->minValue(0)
                            ->numeric()
                            ->default(null),
                        TextInput::make('agent_price')
                            ->label('Harga Agen')
                            ->minValue(0)
                            ->numeric()
                            ->default(null),
                        TextInput::make('min_stock')
                            ->label('Stok Minimal')
                            ->numeric()
                            ->minValue(0)
                            ->default(null),
                        Hidden::make('active')
                            ->default(true),
                    ]),
            ]);
    }
}
