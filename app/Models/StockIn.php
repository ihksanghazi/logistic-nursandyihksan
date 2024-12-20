<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockIn extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];
    // protected $fillable = ['kode_barang', 'quantity', 'origin', 'tanggal_masuk'];
    // protected $primaryKey = 'id';

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'kode_barang', 'kode_barang');
    }

    protected static function booted()
    {
        static::creating(function (StockIn $stock) {
            $stock->no_barang_masuk = 'BM-' . substr($stock->id, strlen($stock->id) - 12);
        });
    }
}
