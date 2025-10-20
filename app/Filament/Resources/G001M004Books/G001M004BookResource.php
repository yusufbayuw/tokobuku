<?php

namespace App\Filament\Resources\G001M004Books;

use App\Filament\Resources\G001M004Books\Pages\CreateG001M004Book;
use App\Filament\Resources\G001M004Books\Pages\EditG001M004Book;
use App\Filament\Resources\G001M004Books\Pages\ListG001M004Books;
use App\Filament\Resources\G001M004Books\Pages\ViewG001M004Book;
use App\Filament\Resources\G001M004Books\RelationManagers\StockBalancesRelationManager;
use App\Filament\Resources\G001M004Books\Schemas\G001M004BookForm;
use App\Filament\Resources\G001M004Books\Schemas\G001M004BookInfolist;
use App\Filament\Resources\G001M004Books\Tables\G001M004BooksTable;
use App\Models\G001M004Book;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G001M004BookResource extends Resource
{
    protected static ?string $model = G001M004Book::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'book';
    protected static ?string $modelLabel = 'Buku';
    protected static ?string $navigationLabel = 'Buku';

    public static function form(Schema $schema): Schema
    {
        return G001M004BookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M004BookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M004BooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StockBalancesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListG001M004Books::route('/'),
            'create' => CreateG001M004Book::route('/create'),
            'view' => ViewG001M004Book::route('/{record}'),
            'edit' => EditG001M004Book::route('/{record}/edit'),
        ];
    }
}
