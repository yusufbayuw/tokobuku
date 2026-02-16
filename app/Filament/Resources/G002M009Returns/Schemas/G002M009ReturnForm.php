<?php

namespace App\Filament\Resources\G002M009Returns\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Database\Eloquent\Builder;

class G002M009ReturnForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('from_location_id')
                    ->label('Lokasi Pengirim')
                    ->searchable()
                    ->preload()
                    ->relationship(
                        name: 'fromLocation',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query, Get $get) => $query->when($get('to_location_id'), fn ($query, $id) => $query->where('id', '!=', $id))
                    )
                    ->reactive()
                    ->disabledOn('edit')
                    ->default(null),
                Select::make('to_location_id')
                    ->label('Lokasi Penerima')
                    ->searchable()
                    ->preload()
                    ->disabledOn('edit')
                    ->relationship(
                        name: 'toLocation',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query, Get $get) => $query->when($get('from_location_id'), fn ($query, $id) => $query->where('id', '!=', $id))
                    )
                    ->reactive()
                    ->default(null),
                Select::make('handled_by')
                    ->label('Ditangani Oleh')
                    ->searchable()
                    ->disabledOn('edit')
                    ->preload()
                    ->relationship('handler', 'name')
                    ->default(auth()->user()->id),
                DatePicker::make('return_date')
                    ->label('Tanggal Distribusi')
                    ->default(null),
                Textarea::make('note')
                    ->label('Catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
