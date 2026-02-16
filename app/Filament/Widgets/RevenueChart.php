<?php

namespace App\Filament\Widgets;

use App\Models\G003M011Sale;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RevenueChart extends ChartWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Grafik Pendapatan (6 Bulan Terakhir)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $user = Auth::user();

        $data = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();

            $query = G003M011Sale::query();

            // Scope to user role
            if (!$user->hasRole(['super_admin', 'admin'])) {
                $locationIds = $user->locations->pluck('id');
                $query->whereIn('g002_m007_location_id', $locationIds);
            }

            $revenue = $query->where('status', 'final')
                ->whereBetween('sale_date', [$start, $end])
                ->sum('total');

            $data[] = $revenue;
            $labels[] = $date->format('M Y');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
