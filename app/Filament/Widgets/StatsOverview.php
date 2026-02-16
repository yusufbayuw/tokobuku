<?php

namespace App\Filament\Widgets;

use App\Models\G003M011Sale;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = G003M011Sale::query();

        // Scope to user's location if not super_admin/admin
        if (!$user->hasRole(['super_admin', 'admin'])) {
            $locationIds = $user->locations->pluck('id');
            $query->whereIn('g002_m007_location_id', $locationIds);
        }

        $query->where('status', 'final'); // Assuming 'final' is completed sale

        // Calculate Revenue (Current Month vs Last Month)
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Revenue
        $revenueCurrent = (clone $query)->whereBetween('sale_date', [$currentMonthStart, $currentMonthEnd])->sum('total');
        // Transactions
        $transactionsCurrent = (clone $query)->whereBetween('sale_date', [$currentMonthStart, $currentMonthEnd])->count();
        // Profit
        $profitCurrent = (clone $query)->whereBetween('sale_date', [$currentMonthStart, $currentMonthEnd])->sum('total_margin');

        // Comparison for Revenue
        $revenueLast = (clone $query)->whereBetween('sale_date', [$lastMonthStart, $lastMonthEnd])->sum('total');
        $diff = $revenueCurrent - $revenueLast;
        $trend = $revenueLast > 0 ? (int) (($diff / $revenueLast) * 100) : 100;

        return [
            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenueCurrent, 0, ',', '.'))
                ->description($revenueLast > 0 ? ($diff > 0 ? '+' : '') . $trend . '% dari bulan lalu' : 'Data bulan lalu belum ada')
                ->descriptionIcon($diff > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($diff > 0 ? 'success' : 'danger'),
            Stat::make('Jumlah Transaksi', number_format($transactionsCurrent, 0, ',', '.'))
                ->description('Total transaksi bulan ini')
                ->color('info'),
            Stat::make('Profit Bersih', 'Rp ' . number_format($profitCurrent, 0, ',', '.'))
                ->description('Estimasi keuntungan bersih')
                ->color('success'),
        ];
    }
}
