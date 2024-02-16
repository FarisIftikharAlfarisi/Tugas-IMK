<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\CapaianProduksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Produk::all()->sortDesc();
        return view('layouts.form_lapor',compact('products'));
    }

    public function riwayat_capaian_produksi(){
        $user_id = Auth::user()->id;
        $my_prod = CapaianProduksi::query()->where('user_id',$user_id)->get()->sortDesc();
        return view('layouts.riwayatcapaian',compact('my_prod'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_capaian(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'brand' => 'required',
            'jumlah_produksi' => 'required|numeric'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $set_location = 'Asia/Jakarta';
        $dates = new DateTime('now', new DateTimeZone($set_location));
        $tanggal= $dates;

        $user = Auth::user()->id;

        $data['tanggal_pelaporan'] = $tanggal;
        $data['user_id'] = $user;
        $data['produk_id'] = $request['brand'];
        $data['total_produksi'] = $request->jumlah_produksi;

        //mengkalikan ongkos produksi dengan capaian_produksi untuk disimpan sebagai upah
        $ongkos = Produk::findOrFail($data['produk_id']);
        $upah = $ongkos->ongkos_jahit *  $data['total_produksi'];
        $data['upah_produksi'] = $upah;

        CapaianProduksi::create($data);

        return redirect()->route('landing_produksi')->with('success','Berhasil melaporkan capaian produksi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
