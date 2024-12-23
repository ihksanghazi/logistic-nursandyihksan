<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\StockIn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = Stock::all();

        foreach (range(1, 5) as $index) {
            StockIn::create([
                'kode_barang' => $stocks->random()->kode_barang,
                'user_id' => $stocks->random()->user_id,
                'quantity' => fake('id_ID')->numberBetween(1, 5),
                'origin' => fake('id_ID')->city(),
                'tanggal_masuk' => fake('id_ID')->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
