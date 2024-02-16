<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'brand',
        'nama_produk',
        'ongkos_jahit',
    ];

    public function untuk_capaian(){
        return $this->hasMany(CapaianProduksi::class);
    }
}
