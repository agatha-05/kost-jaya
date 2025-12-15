<?php 
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget; 
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\BoardingHouse;
use App\Models\City;
use App\Models\Transaction; 
use Carbon\Carbon;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('🏡 Total Rumah Kost', BoardingHouse::count())
                ->description('Jumlah semua properti terdaftar')
                ->color('primary'), 
            
            Stat::make('🏙️ Total Kota', City::count())
                ->description('Area operasional yang dikelola')
                ->color('success'),
                
            Stat::make('💰 Transaksi Bulan Ini', 
                Transaction::whereMonth('created_at', now()->month)
                    ->where('payment_status', 'completed') // <-- PERBAIKAN ERROR #3
                    ->count()
            )
                ->description('Transaksi berhasil di bulan ini')
                ->color('warning'),
        ];
    }
}