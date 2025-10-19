<?php

namespace App\Filament\Resources\G001M001Authors\RelationManagers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\G001M004Books\G001M004BookResource;
use App\Filament\Resources\G001M001Authors\G001M001AuthorResource;
use App\Models\G001M004Book;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';
    protected static null|string $inverseRelationship = 'authors';
    protected static ?string $recordTitleAttribute = 'Buku';
    protected static ?string $title = '';


    //protected static ?string $relatedResource = G001M004BookResource::class;


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
                        TextInput::make('title')->required(),
                        TextInput::make('isbn')->nullable(),
                        TextInput::make('retail_price')->numeric()->default(0),
                    ]),
            ]);
    }
}
