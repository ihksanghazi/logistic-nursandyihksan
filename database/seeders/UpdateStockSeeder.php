<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = Stock::all();

        foreach ($stocks as $stock) {
            $totalStockIn = StockIn::where('kode_barang', $stock->kode_barang)->sum('quantity');
            $totalStockOut = StockOut::where('kode_barang', $stock->kode_barang)->sum('quantity');

            $newStock = $stock->stok_tersedia + $totalStockIn - $totalStockOut;

            $stock->update(['stok_tersedia' => $newStock]);
        }
    }
}
