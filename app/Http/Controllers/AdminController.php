<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Exports\CapaianExport;
use App\Models\CapaianProduksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CapaianByTanggalExport;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $sevenDayAgo = $today->subDays(+7);

        $set_location = 'Asia/Jakarta';
        $dates = new DateTime('now', new DateTimeZone($set_location));

        $estimasi_anggaran_gaji =  CapaianProduksi::where('tanggal_pelaporan','>=',$sevenDayAgo);
        $estimasi_anggaran_gaji = $estimasi_anggaran_gaji->sum('upah_produksi');

        $leaderboard = CapaianProduksi::select('user_id', DB::raw('SUM(total_produksi) AS total_capaian_sum'))
        ->join('users', 'users.id', '=', 'capaian_produksis.user_id')
        ->groupBy('user_id')->orderBy('total_capaian_sum','desc')->limit(3)->get();

        $leaderboard_produk = CapaianProduksi::select('produk_id', DB::raw('SUM(total_produksi) AS total_producted_sum'))
        ->join('produks', 'produks.id', '=', 'capaian_produksis.produk_id')
        ->groupBy('produk_id')->orderBy('total_producted_sum','desc')->limit(3)->get();

        return view('layouts.admin.welcome',compact(['estimasi_anggaran_gaji','leaderboard','leaderboard_produk','dates']));
    }

    //untuk fitur tambahan, search data menggunakan tanggal untuk capaian produksi
    public function filtercapaian(Request $request)
    {
        //filter tanggal
        $tanggalAwal = $request->tanggal_start;
        $tanggalAkhir = $request->tanggal_end;


        $tanggalAwal = (new DateTime($tanggalAwal))->format('Y-m-d');
        $tanggalAkhir = (new DateTime($tanggalAkhir))->format('Y-m-d');
        // dd($tanggalAwal,$tanggalAkhir);

        $capaian_produksi = CapaianProduksi::whereBetween('tanggal_pelaporan', [$tanggalAwal, $tanggalAkhir])->get();
        return view('layouts.admin.capaian',compact('capaian_produksi'));
    }

    public function production_view()
    {
        $capaian_produksi = CapaianProduksi::all()->sortDesc();
        return view('layouts.admin.capaian')->with(compact('capaian_produksi'));
    }

    public function alluser()
    {
        $users = User::all();
        return view('layouts.admin.pengguna',compact('users'));
    }

    public function newuser()
    {
        return view('layouts.admin.tambahuser');
    }

    public function brand_view()
    {
        $products = Produk::all()->sortDesc();
        return view('layouts.admin.produk',compact('products'));
    }

    public function add_brand()
    {
        return view('layouts.admin.tambahproduk');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_user(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_telepon' => 'required',
            'role' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['no_telepon'] = $request->no_telepon;
        $data['role'] = $request->role;

        User::create($data);

        return redirect()->route('daftar_pengguna')->with('success','Berhasil menambahkan pengguna');
    }

    public function create_brand(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_produk' => 'required',
            'brand' => 'required',
            'nama_produk' => 'required',
            'ongkos_jahit' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['kode_produk'] = $request->kode_produk;
        $data['brand'] = $request->brand;
        $data['nama_produk'] = $request->nama_produk;
        $data['ongkos_jahit'] = $request->ongkos_jahit;

        Produk::create($data);

        return redirect()->route('brand_list')->with('success','Berhasil menambahkan produk baru');
    }

    public function editCapaian(Request $request,$id){
        $data = CapaianProduksi::find($id);
        $data_produk = Produk::all();
        return view('layouts.admin.editcapaian',compact('data','data_produk'));
    }

    public function updateCapaian(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'produk' => 'nullable',
            'total_produksi' => 'nullable'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['produk_id'] = $request->produk;
        $data['total_produksi'] = $request->total_produksi;

        CapaianProduksi::whereId($id)->update($data);

        return redirect()->route('capaian')->with('success','Berhasil mengubah capaian produksi');
    }

    //eksport capaian ke excel
    public function exportCapaian(){
        return Excel::download(new CapaianExport,'capaian-produksi.xlsx');
    }

    public function exportCapaianByTanggal(Request $request){
        $startdate = $request->tanggal_start;
        $enddate = $request->tanggal_end;

        $startdate = (new DateTime($startdate))->format('Y-m-d');
        $enddate = (new DateTime($enddate))->format('Y-m-d');

        return Excel::download(new CapaianByTanggalExport($startdate, $enddate),
        'capaian-produksi-by-tanggal-'.$startdate.'-'.$enddate.'.xlsx');
    }

    public function editPengguna(Request $request,$id){
        $data = User::find($id);
        return view('layouts.admin.edituser',compact('data'));
    }

    public function updatePengguna(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'role' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['no_telepon'] = $request->no_telepon;
        $data['role'] = $request->role;

        User::whereId($id)->update($data);

        return redirect()->route('daftar_pengguna')->with('success','Berhasil mengubah data pengguna!');
    }

    public function deletePengguna($id)
    {
        // Hapus pengguna
        $pengguna = User::find($id);
        if($pengguna){
            $pengguna->delete();
        }
        return redirect()->route('daftar_pengguna')->with('success','Pengguna berhasil dihapus');
    }


    public function editBrand(Request $request,$id){
        $data = Produk::find($id);
        return view('layouts.admin.editproduk',compact('data'));
    }

    public function updateBrand(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'kode_produk' => 'max:255',
            'brand' => 'max:255',
            'nama_produk' => 'max:255',
            'ongkos_jahit' => 'max:255',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors('errors',$validator);
        }

        $data['kode_produk'] = $request->kode_produk;
        $data['brand'] = $request->brand;
        $data['nama_produk'] = $request->nama_produk;
        $data['ongkos_jahit'] = $request->ongkos_jahit;

        Produk::whereId($id)->update($data);

        return redirect()->route('brand_list')->with('success','Berhasil mengubah data produk!');
    }

    public function deleteBrand(Request $request, $id)
    {
        // Hapus pengguna
        $produk= Produk::find($id);
        $produk->delete();
        return redirect()->route('brand_list')->with('success','Produk berhasil dihapus');
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
