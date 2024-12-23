<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first();

        $stocks = [
            ['nama_barang' => 'barang A', 'stok_tersedia' => 100],
            ['nama_barang' => 'barang B', 'stok_tersedia' => 100],
            ['nama_barang' => 'barang C', 'stok_tersedia' => 100],
            ['nama_barang' => 'barang D', 'stok_tersedia' => 100],
            ['nama_barang' => 'barang E', 'stok_tersedia' => 100],
        ];

        foreach ($stocks as $index) {
            Stock::create($index);
        };
    }
}
