<?php

namespace App\Filament\Resources\G002M013StockCorrections;

use App\Filament\Resources\G002M008StockBalances\G002M008StockBalanceResource;
use App\Filament\Resources\G002M013StockCorrections\Pages\CreateG002M013StockCorrection;
use App\Filament\Resources\G002M013StockCorrections\Pages\EditG002M013StockCorrection;
use App\Filament\Resources\G002M013StockCorrections\Pages\ListG002M013StockCorrections;
use App\Filament\Resources\G002M013StockCorrections\Pages\ViewG002M013StockCorrection;
use App\Filament\Resources\G002M013StockCorrections\Schemas\G002M013StockCorrectionForm;
use App\Filament\Resources\G002M013StockCorrections\Schemas\G002M013StockCorrectionInfolist;
use App\Filament\Resources\G002M013StockCorrections\Tables\G002M013StockCorrectionsTable;
use App\Models\G002M013StockCorrection;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G002M013StockCorrectionResource extends Resource
{
    
    protected static ?string $model = G002M013StockCorrection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CheckCircle;
    protected static string|UnitEnum|null $navigationGroup = '🏛️ Inventori & Lokasi';
    protected static ?string $slug = 'stock-correction';
    protected static ?string $modelLabel = 'Koreksi Stok';
    protected static ?string $navigationLabel = 'Koreksi Stok';

    protected static ?string $parentResource = G002M008StockBalanceResource::class;

    public static function form(Schema $schema): Schema
    {
        return G002M013StockCorrectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G002M013StockCorrectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G002M013StockCorrectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListG002M013StockCorrections::route('/'),
            //'create' => CreateG002M013StockCorrection::route('/create'),
            //'view' => ViewG002M013StockCorrection::route('/{record}'),
            //'edit' => EditG002M013StockCorrection::route('/{record}/edit'),
        ];
    }
}
