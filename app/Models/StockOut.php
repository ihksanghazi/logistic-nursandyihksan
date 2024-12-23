<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOut extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];
    // protected $fillable = ['kode_barang', 'quantity', 'destination', 'tanggal_keluar'];
    protected $primaryKey = 'id';

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'kode_barang', 'kode_barang');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted()
    {
        static::creating(function (StockOut $stock) {
            $stock->no_barang_keluar = 'BK-' . substr($stock->id, strlen($stock->id) - 12);
        });
    }
}
