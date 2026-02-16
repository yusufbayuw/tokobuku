<?php

namespace App\Filament\Resources\G002M009Returns\RelationManagers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\G002M009Return;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use App\Models\G002M008StockBalance;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Actions\DissociateBulkAction;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;

class ItemsRelationManager extends RelationManager
{
    //protected static ?string $relatedResource = \App\Filament\Resources\G002M010ReturnItems\G002M010ReturnItemResource::class;

    protected static string $relationship = 'items';
    protected static ?string $recordTitleAttribute = 'Distribusi Buku';
    protected static ?string $modelLabel = 'Distribusi Buku';
    protected static ?string $title = '';

    public function form(Schema $schema): Schema
    {
        $getStockQty = function ($bookId) {
            if (! $bookId) {
                return null;
            }

            $fromLocationId = $this->getOwnerRecord()->from_location_id;

            if (! $fromLocationId) {
                return null;
            }

            return G002M008StockBalance::where('g002_m007_location_id', $fromLocationId)
                ->where('g001_m004_book_id', $bookId)
                ->value('qty');
        };

        return $schema
            ->components([
                Select::make('g001_m004_book_id')
                    ->label('Buku')
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->relationship(
                        name: 'book',
                        titleAttribute: 'title',
                        modifyQueryUsing: function (Builder $query) {
                            $fromLocationId = $this->getOwnerRecord()->from_location_id;

                            if (!$fromLocationId) {
                                return $query->whereRaw('1 = 0');
                            }

                            return $query->whereIn('id', function ($query) use ($fromLocationId) {
                                $query->select('g001_m004_book_id')
                                    ->from('g002_m008_stock_balances')
                                    ->where('g002_m007_location_id', $fromLocationId)
                                    ->where('qty', '>', 0);
                            });
                        }
                    ),
                TextInput::make('qty')
                    ->label('Jumlah')
                    ->reactive()
                    ->disabled(fn ($get) => ! $get('g001_m004_book_id'))
                    ->maxValue(function ($get) use ($getStockQty) {
                        $qty = $getStockQty($get('g001_m004_book_id'));

                        return $qty ?? 0;
                    })
                    ->hint(function ($get) use ($getStockQty) {
                        $qty = $getStockQty($get('g001_m004_book_id'));

                        if ($qty !== null) {
                            return 'Stok tersedia: ' . $qty;
                        }

                        return 'Pilih distribusi dan buku yang sesuai';
                    })
                    ->minValue(1)
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('book.title')
            ->columns([
                TextColumn::make('book.title')
                    ->label('Buku')
                    ->sortable(),
                TextColumn::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                //AssociateAction::make(),
            ])
            ->recordActions([
                //EditAction::make(),
                //DissociateAction::make(),
                //DeleteAction::make(),
            ])
            ->toolbarActions([
                //BulkActionGroup::make([
                //    DissociateBulkAction::make(),
                //    DeleteBulkAction::make(),
                //]),
            ]);
    }
}
