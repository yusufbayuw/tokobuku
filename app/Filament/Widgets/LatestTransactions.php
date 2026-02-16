<?php

namespace App\Filament\Widgets;

use App\Models\G003M011Sale;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class LatestTransactions extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */

        return $table
            ->query(
                fn() => G003M011Sale::query()
                    ->when(!$user->hasRole(['super_admin', 'admin']), function ($query) use ($user) {
                        $query->whereIn('g002_m007_location_id', $user->locations->pluck('id'));
                    })
                    ->latest('sale_date')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('invoice_no')
                    ->label('No. Invoice')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sale_date')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),
                Tables\Columns\TextColumn::make('customer_name') // Assuming direct column or relationship?
                    ->label('Pelanggan')
                    ->default('-'), // If customer relationship exists, use customer.name
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'warning',
                        'final' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->paginated(false);
    }
}
