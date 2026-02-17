<?php

namespace App\Filament\Resources\G001M002Categories\Pages;

use App\Filament\Resources\G001M002Categories\G001M002CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListG001M002Categories extends ListRecords
{
    protected static string $resource = G001M002CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn() => \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\TemplateCategoryExport, 'template_categories.xlsx')),
            CreateAction::make(),
        ];
    }
}
