<?php 

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionChart extends ChartWidget
{

    protected int | string | array $columnSpan = 'full'; 
    protected static ?string $heading = 'Tren Transaksi (6 Bulan Terakhir)';
    protected static ?int $sort = 2; 

    protected function getData(): array
    {
        
        $months = collect(range(5, 0))->map(function (int $i) {
            return Carbon::now()->subMonths($i);
        });

        
        $data = $months->map(function (Carbon $month) {
            return Transaction::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                // Pastikan menggunakan payment_status
                ->where('payment_status', 'completed') 
                ->count();
        });

        
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi Selesai',
                    'data' => $data->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
          
            'labels' => $months->map(fn (Carbon $month) => $month->shortMonthName)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line'; 
    }
}