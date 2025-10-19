<?php

namespace App\Filament\Resources\G001M003Publishers\RelationManagers;

use Filament\Tables\Table;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\G001M004Books\G001M004BookResource;
use Filament\Actions\AssociateAction;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';

    protected static null|string $inverseRelationship = 'publisher';
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
                AssociateAction::make()
                    ->label('Pilih Buku yang Ada')
                    ->multiple()
                    ->preloadRecordSelect()
                    ->recordTitleAttribute('title'),

                CreateAction::make()
                    ->label('Buat Buku Baru')
                    ->using(function (array $data) {
                        // buat buku baru
                        $book = \App\Models\G001M004Book::create($data);

                        $book->g001_m003_publisher_id = $this->getOwnerRecord()->id;
                        $book->saveQuietly();

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
