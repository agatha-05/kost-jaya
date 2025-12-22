<?php 
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget; 
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\BoardingHouse;
use App\Models\City;
use App\Models\Transaction;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('🏡 Total Rumah Kost', BoardingHouse::count())
                ->description('Jumlah semua properti terdaftar')
                ->color('primary')
                ->extraAttributes([
                    'class' => '
                        transition-all duration-300 ease-out
                        hover:scale-105
                        hover:-translate-y-2
                        hover:bg-primary-50
                        cursor-pointer
                    ',
                ]),

            Stat::make('🏙️ Total Kota', City::count())
                ->description('Area operasional yang dikelola')
                ->color('success')
                ->extraAttributes([
                    'class' => '
                        transition-all duration-300 ease-out
                        hover:scale-105
                        hover:-translate-y-2
                        hover:bg-success-50
                        cursor-pointer
                    ',
                ]),
                
            Stat::make(
                '💰 Transaksi Bulan Ini', 
                Transaction::whereMonth('created_at', now()->month)
                    ->where('payment_status', 'completed')
                    ->count()
            )
                ->description('Transaksi berhasil di bulan ini')
                ->color('warning')
                ->extraAttributes([
                    'class' => '
                        transition-all duration-300 ease-out
                        hover:scale-105
                        hover:-translate-y-2
                        hover:bg-warning-50
                        cursor-pointer
                    ',
                ]),
        ];
    }
}
