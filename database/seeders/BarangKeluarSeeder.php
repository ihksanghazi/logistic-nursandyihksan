<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = Stock::all();

        foreach (range(1, 5) as $index) {
            StockOut::create([
                'kode_barang' => $stocks->random()->kode_barang,
                'user_id' => $stocks->random()->user_id,
                'quantity' => fake('id_ID')->numberBetween(1, 5),
                'destination' => fake('id_ID')->city(),
                'tanggal_keluar' => fake('id_ID')->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
