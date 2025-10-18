<?php

namespace App\Filament\Resources\G001M002Categories;

use App\Filament\Resources\G001M002Categories\Pages\CreateG001M002Category;
use App\Filament\Resources\G001M002Categories\Pages\EditG001M002Category;
use App\Filament\Resources\G001M002Categories\Pages\ListG001M002Categories;
use App\Filament\Resources\G001M002Categories\Pages\ViewG001M002Category;
use App\Filament\Resources\G001M002Categories\Schemas\G001M002CategoryForm;
use App\Filament\Resources\G001M002Categories\Schemas\G001M002CategoryInfolist;
use App\Filament\Resources\G001M002Categories\Tables\G001M002CategoriesTable;
use App\Models\G001M002Category;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class G001M002CategoryResource extends Resource
{
    protected static ?string $model = G001M002Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = '📚 Master Data Buku';
    protected static ?string $slug = 'category';
    protected static ?string $modelLabel = 'Kategori';
    protected static ?string $navigationLabel = 'Kategori';

    public static function form(Schema $schema): Schema
    {
        return G001M002CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return G001M002CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return G001M002CategoriesTable::configure($table);
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
            'index' => ListG001M002Categories::route('/'),
            'create' => CreateG001M002Category::route('/create'),
            'view' => ViewG001M002Category::route('/{record}'),
            'edit' => EditG001M002Category::route('/{record}/edit'),
        ];
    }
}
