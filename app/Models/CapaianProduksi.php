<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapaianProduksi extends Model
{
    use HasFactory;

    protected $fillable =[
        'tanggal_pelaporan',
        'user_id',
        'produk_id',
        'total_produksi',
        'upah_produksi'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
