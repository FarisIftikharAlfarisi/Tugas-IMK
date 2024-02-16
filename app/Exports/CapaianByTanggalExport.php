<?php

namespace App\Exports;

use App\Models\CapaianProduksi;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CapaianByTanggalExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    private $startdate;
    private $enddate;

    public function __construct($startdate,$enddate) {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    public function query(){
        return CapaianProduksi::whereBetween('tanggal_pelaporan', [$this->startdate, $this->enddate])->with(['user','produk'])->first();
    }

    public function map($capaianProduksi): array{
        return [
            $capaianProduksi->tanggal_pelaporan->format('d-m-Y'),
            $capaianProduksi->user->username,
            $capaianProduksi->produk->brand,
            $capaianProduksi->produk->nama_produk,
            $capaianProduksi->total_produksi,
            $capaianProduksi->upah_produksi
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
