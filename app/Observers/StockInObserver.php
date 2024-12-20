<?php

namespace App\Observers;

use App\Models\Stock;
use App\Models\StockIn;

class StockInObserver
{
    /**
     * Handle the StockIn "created" event.
     */
    public function created(StockIn $stockIn): void
    {
        $stock = Stock::where('kode_barang', $stockIn->kode_barang)->first();
        $stock->stok_tersedia += $stockIn->quantity;
        $stock->save();
    }

    /**
     * Handle the StockIn "updated" event.
     */
    public function updated(StockIn $stockIn): void
    {
        //
    }

    /**
     * Handle the StockIn "deleted" event.
     */
    public function deleted(StockIn $stockIn): void
    {
        //
    }

    /**
     * Handle the StockIn "restored" event.
     */
    public function restored(StockIn $stockIn): void
    {
        //
    }

    /**
     * Handle the StockIn "force deleted" event.
     */
    public function forceDeleted(StockIn $stockIn): void
    {
        //
    }
}
