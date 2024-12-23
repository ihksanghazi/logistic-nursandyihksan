<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];
    // protected $fillable = ['nama_barang', 'stok_tersedia'];
    protected $primaryKey = 'id';

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class, 'kode_barang', 'kode_barang');
    }

    public function stockOuts(): HasMany
    {
        return $this->hasMany(StockOut::class, 'kode_barang', 'kode_barang');
    }

    protected static function booted()
    {
        static::creating(function (Stock $stock) {
            $stock->kode_barang = 'BRG-' . substr($stock->id, strlen($stock->id) - 12);
        });
    }
}
