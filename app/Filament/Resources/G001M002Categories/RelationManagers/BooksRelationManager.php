<?php

namespace App\Filament\Resources\G001M002Categories\RelationManagers;

use Filament\Tables\Table;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\G001M002Categories\G001M002CategoryResource;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';
    protected static null|string $inverseRelationship = 'categories';
    protected static ?string $recordTitleAttribute = 'Buku';
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
            ->headerActions([
                AttachAction::make()
                    ->label('Pilih Buku yang Ada')
                    ->multiple()
                    ->preloadRecordSelect()
                    ->recordTitleAttribute('title'),

                CreateAction::make()
                    ->label('Buat Buku Baru')
                    ->using(function (array $data) {
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
