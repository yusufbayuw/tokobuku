<?php

namespace App\Filament\Resources\G001M006CategoryBooks;

use App\Filament\Resources\G001M006CategoryBooks\Pages\CreateG001M006CategoryBook;
use App\Filament\Resources\G001M006CategoryBooks\Pages\EditG001M006CategoryBook;
use App\Filament\Resources\G001M006CategoryBooks\Pages\ListG001M006CategoryBooks;
use App\Filament\Resources\G001M006CategoryBooks\Pages\ViewG001M006CategoryBook;
use App\Filament\Resources\G001M006CategoryBooks\Schemas\G001M006CategoryBookForm;
use App\Filament\Resources\G001M006CategoryBooks\Schemas\G001M006CategoryBookInfolist;
use App\Filament\Resources\G001M006CategoryBooks\Tables\G001M006CategoryBooksTable;
use App\Models\G001M006CategoryBook;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G001M006CategoryBookResource extends Resource
{
    protected static ?string $model = G001M006CategoryBook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'category-book-tag-170845';
    protected static ?string $modelLabel = 'Buku Terkategori';
    protected static ?string $navigationLabel = 'Buku Terkategori';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return G001M006CategoryBookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M006CategoryBookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M006CategoryBooksTable::configure($table);
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
            'index' => ListG001M006CategoryBooks::route('/'),
            'create' => CreateG001M006CategoryBook::route('/create'),
            'view' => ViewG001M006CategoryBook::route('/{record}'),
            'edit' => EditG001M006CategoryBook::route('/{record}/edit'),
        ];
    }
}
