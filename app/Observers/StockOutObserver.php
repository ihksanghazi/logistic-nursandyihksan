<?php

namespace App\Observers;

use App\Models\Stock;
use App\Models\StockOut;

class StockOutObserver
{
    /**
     * Handle the StockOut "created" event.
     */
    public function created(StockOut $stockOut): void
    {
        $stock = Stock::where('kode_barang', $stockOut->kode_barang)->first();
        $stock->stok_tersedia -= $stockOut->quantity;
        $stock->save();
    }

    /**
     * Handle the StockOut "updated" event.
     */
    public function updated(StockOut $stockOut): void
    {
        //
    }

    /**
     * Handle the StockOut "deleted" event.
     */
    public function deleted(StockOut $stockOut): void
    {
        $stock = Stock::where('kode_barang', $stockOut->kode_barang)->first();
        $stock->stok_tersedia += $stockOut->quantity;
        $stock->save();
    }

    /**
     * Handle the StockOut "restored" event.
     */
    public function restored(StockOut $stockOut): void
    {
        //
    }

    /**
     * Handle the StockOut "force deleted" event.
     */
    public function forceDeleted(StockOut $stockOut): void
    {
        //
    }
}
