<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProduksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome')->name('welcome');
});

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-process',[LoginController::class,'loginProcess'])->name('login-process');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::group(['middleware' => ['auth','Role:PRODUKSI']], function(){
    //lapor produksi
    Route::get('/produksiku/lapor-hasil',[ProduksiController::class,'index'])->name('landing_produksi');
    Route::post('/produksiku/proses-simpan',[ProduksiController::class,'create_capaian'])->name('proses-simpan-capaian');

    //riwayat capaian
    Route::get('/produksiku/riwayat-capaian', [ProduksiController::class, 'riwayat_capaian_produksi'])->name('riwayat_capaian');

});
Route::group(['middleware' => ['auth','Role:ADMIN']], function(){
    //dashboard admin
    Route::get('/dashboard',[AdminController::class,'index'])->name('landing_admin');
    Route::get('/dashboard/capaian-produksi/',[AdminController::class,'production_view'])->name('capaian');
    Route::get('/dashboard/capaian-produksi/edit/{id}',[AdminController::class,'editCapaian'])->name('edit_capaian');
    Route::put('/dashboard/capaian-produksi/proses-update/{id}',[AdminController::class,'updateCapaian'])->name('update_capaian');

    //filter tanggal
    Route::get('/dashboard/capaian-produksi/filter',[AdminController::class,'filtercapaian'])->name('filter_tanggal_capaian');
    // Route::get('/dashboard/capaian-produksi/search/',[AdminController::class,'searchcapaian'])->name('search_capaian');
    Route::get('dashboard/capaian-produksi/export-excel',[AdminController::class,'exportCapaian'])->name('export_capaian');
    Route::post('dashboard/capaian-produksi/export-excel/by-tanggal',[AdminController::class,'exportCapaianByTanggal'])->name('export_capaian_by_tanggal');

    //menambah pengguna dan melihat pengguna
    Route::get('/dashboard/daftar-pengguna/',[AdminController::class,'alluser'])->name('daftar_pengguna');
    Route::get('/dashboard/daftar-pengguna-baru/',[AdminController::class,'newuser'])->name('pengguna_baru');
    Route::post('/dashboard/register-pengguna-baru',[AdminController::class,'create_user'])->name('proses_register');
    Route::get('/dashboard/pengguna/{id}',[AdminController::class,'editPengguna'])->name('edit.pengguna');
    Route::put('/dashboard/pengguna/proses-update/{id}',[AdminController::class,'updatePengguna'])->name('update.pengguna');
    Route::delete('/dashboard/pengguna/delete/{id}',[AdminController::class,'deletePengguna'])->name('delete.pengguna');

    //menambah brand dan melihat list brand
    Route::get('/dashboard/daftar-brand/',[AdminController::class,'brand_view'])->name('brand_list');
    Route::get('/dashboard/daftar-brand-baru/',[AdminController::class,'add_brand'])->name('add_brand');
    Route::post('/dashboard/register-brand-baru/',[AdminController::class,'create_brand'])->name('proses_tambah_produk');
    Route::get('/dashboard/brand/edit/{id}',[AdminController::class,'editBrand'])->name('edit_brand');
    Route::put('/dashboard/brand/proses-update/{id}',[AdminController::class,'updateBrand'])->name('update_brand');
    Route::delete('/dashboard/brand/proses-delete/{id}',[AdminController::class,'deleteBrand'])->name('delete.brand');

});

