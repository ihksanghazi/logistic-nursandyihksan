<?php

namespace App\Filament\Widgets;

use App\Models\StockOut;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StockOutChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Barang keluar';

    protected function getData(): array
    {
        $startDateFilter = $this->filters['start_date'] ? Carbon::parse($this->filters['start_date']) : null;
        $endDateFilter = $this->filters['end_date'] ? Carbon::parse($this->filters['end_date']) : null;

        $data = Trend::query(StockOut::query()
            ->when($this->filters['kode_barang'], fn($query, $kodeBarang) => $query->where('kode_barang', $kodeBarang)))
            ->between(
                start: $startDateFilter ?? now()->subMonths(6),
                end: $endDateFilter ?? now()
            )
            ->perMonth()
            ->sum('quantity');

        return [
            'datasets' => [
                [
                    'label' => 'Barang Keluar',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
