<?php

namespace Database\Seeders;

use App\Models\CapaianProduksi;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CapaianProduksi::create([
            'tanggal_pelaporan' => date('2024-02-1'),
            'user_id' => 4,
            'produk_id' => 17,
            'total_produksi' => 30,
            'upah_produksi' => Produk::with('ongkos_jahit')->find(2) * 30
        ]);
        CapaianProduksi::create([
            'tanggal_pelaporan' => date('2024-02-1'),
            'user_id' => 4,
            'produk_id' => 16,
            'total_produksi' => 30,
            'upah_produksi' => Produk::with('ongkos_jahit')->find(2) * 30
        ]);
        CapaianProduksi::create([
            'tanggal_pelaporan' => date('2024-02-1'),
            'user_id' => 4,
            'produk_id' => 18,
            'total_produksi' => 30,
            'upah_produksi' => Produk::with('ongkos_jahit')->find(2) * 30
        ]);
    }
}
