<?php

namespace App\Filament\Resources\G001M001Authors\RelationManagers;

use Filament\Tables\Table;
use App\Models\G001M004Book;
use Filament\Schemas\Schema;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\G001M004Books\G001M004BookResource;
use App\Filament\Resources\G001M001Authors\G001M001AuthorResource;
use App\Filament\Resources\G001M002Categories\Schemas\G001M002CategoryForm;
use App\Filament\Resources\G001M003Publishers\Schemas\G001M003PublisherForm;
use Filament\Actions\DetachAction;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';
    protected static null|string $inverseRelationship = 'authors';
    protected static ?string $recordTitleAttribute = 'Buku';
    protected static ?string $modelLabel = 'Buku';
    protected static ?string $title = '';


    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Buku')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Tahun Terbit')
                    ->sortable(),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Pilih Buku yang Ada')
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordTitleAttribute('title'),

                CreateAction::make()
                    ->label('Buat Buku Baru')
                    ->using(function (array $data, $relationManager) {
                        // buat buku baru
                        $book = \App\Models\G001M004Book::create($data);

                        // attach ke author yang sedang aktif
                        $this->getOwnerRecord()->books()->attach($book->id);

                        return $book;
                    })
                    ->schema([
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
                                Select::make('g001_m003_publisher_id')
                                    ->relationship('publisher', titleAttribute: 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Penerbit')
                                    ->createOptionForm(
                                        G001M003PublisherForm::configure(Schema::make())->getComponents()
                                    ),
                                TextInput::make('year')
                                    ->label('Tahun Terbit')
                                    ->numeric()
                                    ->default(null),
                                Select::make('categories')
                                    ->multiple()
                                    ->relationship(titleAttribute: 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label('Kategori Buku')
                                    ->createOptionForm(
                                        G001M002CategoryForm::configure(Schema::make())->getComponents()
                                    ),
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
                    ]),
            ]);
    }
}
