<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['kode_barang', 'quantity', 'origin', 'tanggal_masuk'];
    protected $primaryKey = 'id';

    protected static function booted()
    {
        static::creating(function (StockIn $stock) {
            $stock->no_barang_masuk = 'BM-' . substr($stock->id, strlen($stock->id) - 12);
        });
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'kode_barang');
    }
}
