<?php

namespace App\Filament\Widgets;

use App\Models\Stock;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    use InteractsWithPageFilters;

    protected function getStats(): array
    {

        $kodeBarang = $this->filters['kode_barang'];

        $stock = Stock::with('stockIns', 'stockOuts')->where('kode_barang', $kodeBarang)->first();

        $totalBarang = $stock ? $stock->stok_tersedia : 0;
        $barangMasuk = $stock && $stock->stockIns ? $stock->stockIns->sum('quantity') : 0;
        $barangKeluar = $stock && $stock->stockOuts ? $stock->stockOuts->sum('quantity') : 0;

        return [
            Stat::make('Total Barang', $totalBarang),
            Stat::make('Barang Masuk', $barangMasuk),
            Stat::make('Barang Keluar', $barangKeluar),
        ];
    }
}
