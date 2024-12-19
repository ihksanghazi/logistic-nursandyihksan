<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['nama_barang', 'stok_tersedia'];
    protected $primaryKey = 'id';

    protected static function booted()
    {
        static::creating(function (Stock $stock) {
            $stock->kode_barang = 'BRG-' . substr($stock->id, strlen($stock->id) - 12);
        });
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'kode_barang');
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class, 'kode_barang');
    }
}
