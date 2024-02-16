<?php

namespace App\Exports;

use App\Models\CapaianProduksi;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CapaianExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return  CapaianProduksi::query();
    }

    public function map($capaian): array{
        return [
            $capaian->tanggal_pelaporan,
            $capaian->user->username,
            $capaian->produk->brand,
            $capaian->produk->nama_produk,
            $capaian->total_produksi,
            $capaian->upah_produksi
        ];
    }
    public function headings() :array {
        return [
            'Tanggal',
            'Nama Karyawan',
            'Brand',
            'Nama Produk',
            'Total Produksi (Pcs)',
            'Upah Produksi'
        ];
    }

}
