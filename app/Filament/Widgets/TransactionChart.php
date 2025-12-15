<?php 

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionChart extends ChartWidget
{
    // Menggunakan kolom penuh (full column) agar grafik lebih lebar
    protected int | string | array $columnSpan = 'full'; 
    protected static ?string $heading = 'Tren Transaksi (6 Bulan Terakhir)';
    protected static ?int $sort = 2; // Agar tampil setelah Stats Widget

    protected function getData(): array
    {
        // 1. Definisikan periode dan label (6 bulan terakhir)
        $months = collect(range(5, 0))->map(function (int $i) {
            return Carbon::now()->subMonths($i);
        });

        // 2. Ambil data transaksi per bulan (menggunakan payment_status yang benar)
        $data = $months->map(function (Carbon $month) {
            return Transaction::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                // Pastikan menggunakan payment_status
                ->where('payment_status', 'completed') 
                ->count();
        });

        // 3. Gabungkan data ke dalam format chart
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi Selesai',
                    'data' => $data->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
            // Membuat label bulan (misal: Des, Nov, Okt, dst.)
            'labels' => $months->map(fn (Carbon $month) => $month->shortMonthName)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Grafik Garis
    }
}