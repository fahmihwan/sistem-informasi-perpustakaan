<?php

use App\Http\Controllers\anggota\AnggotaController;
use App\Http\Controllers\anggota\RoleController;
use App\Http\Controllers\authentication\AuthController;
use App\Http\Controllers\buku\BukuController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\master_buku\KategoriController;
use App\Http\Controllers\master_buku\PenerbitController;
use App\Http\Controllers\master_buku\PengarangController;
use App\Http\Controllers\master_buku\RakController;
use App\Http\Controllers\master_buku\Tahun_terbitController;
use App\Http\Controllers\transaksi\PeminjamanController;
use App\Http\Controllers\transaksi\PengembalianController;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('component.main');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('/master-buku/kategori', KategoriController::class);
Route::resource('/master-buku/pengarang', PengarangController::class);
Route::resource('/master-buku/penerbit', PenerbitController::class);
Route::resource('/master-buku/rak', RakController::class);
Route::resource('/master-buku/tahun-terbit', Tahun_terbitController::class);
Route::resource('/buku', BukuController::class);
Route::resource('/anggota/anggota', AnggotaController::class);
Route::resource('/anggota/role', RoleController::class);

Route::resource('/transaksi/peminjaman', PeminjamanController::class);
Route::get('/transaksi/{id}/anggota', [PeminjamanController::class, 'ajax_detail_anggota']);
Route::get('/transaksi/{id}/buku', [PeminjamanController::class, 'ajax_detail_buku']);
Route::resource('/transaksi/pengembalian', PengembalianController::class);
Route::get('/transaksi/{id}/pengembalian', [PengembalianController::class, 'ajax_detail_pengembalian']);
Route::get('/transaksi/{id}/{date}/pengembalian', [PengembalianController::class, 'cek_denda']);


Route::resource('/account', AuthController::class);
Route::get('/login', [AuthController::class, 'login']);
Route::Post('/login', [AuthController::class, 'authenticate']);
