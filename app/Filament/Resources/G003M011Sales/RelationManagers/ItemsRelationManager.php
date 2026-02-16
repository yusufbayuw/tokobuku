<?php

namespace App\Filament\Resources\G003M011Sales\RelationManagers;

use App\Models\G001M004Book;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use App\Models\G002M008StockBalance;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Actions\DissociateBulkAction;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\RawJs;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Hidden;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $recordTitleAttribute = 'Jual Buku';
    protected static ?string $modelLabel = 'Jual Buku';
    protected static ?string $title = '';

    public function form(Schema $schema): Schema
    {
        $getStockQty = function ($bookId) {
            if (!$bookId) {
                return null;
            }

            $fromLocationId = $this->getOwnerRecord()->g002_m007_location_id;

            if (!$fromLocationId) {
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
                    ->required()
                    ->preload()
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {
                        $book = G001M004Book::find($state);
                        if (!$book)
                            return;

                        $set('consumer_price', number_format($book->agent_price, 0, ',', '.'));
                        $set('margin', 0);
                        $set('subtotal_margin', 0);
                    })
                    ->relationship(
                        'book',
                        'title',
                        fn($query) =>
                        $query->whereHas('stocks', function ($query) {
                            $query->where('g002_m007_location_id', $this->getOwnerRecord()->g002_m007_location_id)
                                ->where('qty', '>', 0);
                        })
                    )
                    ->helperText('Hanya menampilkan buku yang tersedia di stok lokasi ini'),
                TextInput::make('consumer_price')
                    ->label('Consumer Price')
                    ->helperText(fn(Get $get) => 'Harga Dasar Rp ' . number_format(G001M004Book::find($get('g001_m004_book_id'))?->agent_price ?? 0, 0, ',', '.'))
                    ->mask(RawJs::make('$money($input, \',\', \'.\', 0)'))
                    ->stripCharacters('.')
                    ->default(0)
                    ->reactive()
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {
                        $bookId = $get('g001_m004_book_id');
                        if (!$bookId)
                            return;

                        $book = G001M004Book::find($bookId);
                        $agentPrice = $book?->agent_price ?? 0;

                        // Parse State
                        $consumerPrice = (int) str_replace('.', '', $state);

                        // Margin = (Price - Discount) - AgentPrice
                        $discountPercentage = $get('discount') ?? 0;
                        $qty = $get('qty') ?? 1;

                        $discountAmount = ($consumerPrice * $discountPercentage) / 100;
                        $effectivePrice = $consumerPrice - $discountAmount;
                        $margin = $effectivePrice - $agentPrice;

                        $set('margin', $margin);
                        $set('subtotal_margin', $margin * $qty);
                    }),

                TextInput::make('discount')
                    ->label('Discount (%)')
                    ->numeric()
                    ->default(0)
                    ->reactive()
                    ->live(onBlur: true)
                    ->suffix('%')
                    ->maxValue(100)
                    ->minValue(0)
                    ->rules([
                        fn(Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                            $bookId = $get('g001_m004_book_id');
                            if (!$bookId)
                                return;

                            $book = G001M004Book::find($bookId);
                            $agentPrice = $book?->agent_price ?? 0;
                            // Parse c_p
                            $consumerPriceVal = $get('consumer_price');
                            $consumerPrice = (int) str_replace('.', '', $consumerPriceVal);

                            $discountAmount = ($consumerPrice * $value) / 100;

                            if (($consumerPrice - $discountAmount) < $agentPrice) {
                                $fail("Discount too high. Selling price cannot be lower than Agent Price ($agentPrice).");
                            }
                        },
                    ])
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {
                        $bookId = $get('g001_m004_book_id');
                        if (!$bookId)
                            return;

                        $book = G001M004Book::find($bookId);
                        $agentPrice = $book?->agent_price ?? 0;

                        $consumerPriceVal = $get('consumer_price');
                        $consumerPrice = (int) str_replace('.', '', $consumerPriceVal);

                        $discountAmount = ($consumerPrice * $state) / 100;
                        $effectivePrice = $consumerPrice - $discountAmount;
                        $margin = $effectivePrice - $agentPrice;
                        $qty = $get('qty') ?? 1;

                        $set('margin', number_format($margin, 0, ',', '.'));
                        $set('subtotal_margin', number_format($margin * $qty, 0, ',', '.'));
                    }),


                TextInput::make('qty')
                    ->label('Jumlah')
                    ->reactive()
                    ->numeric()
                    ->default(1)
                    ->minValue(1)
                    ->disabled(fn(Get $get) => !$get('g001_m004_book_id'))
                    ->maxValue(function (Get $get) use ($getStockQty) {
                        $qty = $getStockQty($get('g001_m004_book_id'));
                        return $qty ?? 0;
                    })
                    ->hint(function (Get $get) use ($getStockQty) {
                        $qty = $getStockQty($get('g001_m004_book_id'));
                        return ($qty !== null) ? 'Stok tersedia: ' . $qty : 'Pilih buku yang sesuai';
                    })
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {
                        // Update subtotal_margin
                        $marginRaw = $get('margin') ?? 0;
                        $margin = (int) str_replace('.', '', $marginRaw);

                        $set('subtotal_margin', number_format($margin * $state, 0, ',', '.'));
                    }),

                TextInput::make('margin')
                    ->label('Margin (Per Unit)')
                    ->required(fn(Get $get) => !$get(''))
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))
                    ->readOnly()
                    ->prefix('Rp'),

                TextInput::make('subtotal_margin')
                    ->label('Total Margin')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))
                    ->readOnly()
                    ->prefix('Rp'),
            ]);
    }



    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')
                    ->label('Buku')
                    ->description(fn($record) => $record->is_correction ? 'Koreksi / Retur' : null)
                    ->icon(fn($record) => $record->is_correction ? Heroicon::OutlinedArrowUturnLeft : null)
                    ->color(fn($record) => $record->is_correction ? 'danger' : null)
                    ->searchable(),
                TextColumn::make('qty')
                    ->numeric()
                    ->label('Jumlah')
                    ->sortable()
                    ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->label('Total Items')),
                TextColumn::make('unit_price')
                    ->label('Harga')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->sortable(),
                TextColumn::make('subtotal')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->sortable()
                    ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->label('Total Value')->numeric(decimalPlaces: 0, thousandsSeparator: '.')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                // Button Tambah Item Normal (Hanya jika Draft)
                CreateAction::make()
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->status === 'draft'),

                // Button Koreksi / Retur (Hanya jika Final)
                Action::make('retur')
                    ->label('Retur / Koreksi')
                    ->color('danger')
                    ->icon(Heroicon::OutlinedArrowUturnLeft)
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->status === 'final')
                    ->form([
                        Select::make('g001_m004_book_id')
                            ->label('Buku yang diretur')
                            ->options(function ($livewire) {
                                // Only show books that were part of this sale
                                return $livewire->getOwnerRecord()->items()
                                    ->where('qty', '>', 0) // Filter out previous returns if any (assuming returns have negative qty)
                                    ->with('book')
                                    ->get()
                                    ->pluck('book.title', 'g001_m004_book_id');
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                // Find original purchase price or invalid state
                                $originalItem = $livewire->getOwnerRecord()->items()
                                    ->where('g001_m004_book_id', $state)
                                    ->where('qty', '>', 0)
                                    ->first();

                                $set('max_qty', $originalItem ? $originalItem->qty : 0);
                            }),
                        TextInput::make('qty')
                            ->label('Jumlah Retur')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(function (Get $get) {
                                return $get('max_qty') ?? 0;
                            })
                            ->hint(fn(Get $get) => 'Maksimal: ' . ($get('max_qty') ?? 0))
                            ->required(),
                        Hidden::make('max_qty'),
                        Hidden::make('is_correction')->default(true),
                    ])
                    ->action(function (array $data, $livewire) {
                        $sale = $livewire->getOwnerRecord();
                        // Find original item to get pricing details for reversal
                        $originalItem = $sale->items()
                            ->where('g001_m004_book_id', $data['g001_m004_book_id'])
                            ->where('qty', '>', 0)
                            ->first();

                        if (!$originalItem) {
                            // Should validation handle this?
                            return;
                        }

                        $qtyReturn = $data['qty'];
                        // Ensure negative qty
                        $qty = -1 * abs($qtyReturn);

                        $sale->items()->create([
                            'g001_m004_book_id' => $data['g001_m004_book_id'],
                            'qty' => $qty,
                            'consumer_price' => $originalItem->consumer_price,
                            'discount' => $originalItem->discount, // This is now percentage
                            'is_correction' => true,
                            // Margin is calculated in observer, but logic in observer needs to handle negative qty correctly
                        ]);

                        $livewire->dispatch('refresh'); // Refresh parent info
                    }),
            ])
            ->recordActions([
                // Delete hanya diizinkan jika status Draft
                DeleteAction::make()
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->status === 'draft'),
            ]);
    }
}
