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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\transaksi\PeminjamanController;
use App\Http\Controllers\transaksi\PengembalianController;
use Illuminate\Routing\RouteGroup;
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



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/anggota/{id}', [DashboardController::class, 'show_sendang_meminjam']);
    Route::get('/dashboard/list-jatuh-tempo', [DashboardController::class, 'show_jatuh_tempo']);
    Route::get('/dashboard/list-peminjaman-bulan-ini', [DashboardController::class, 'show_peminjaman_bulan_ini']);
});



// Route::middleware(['auth', 'role:petugas'])->group(function () {
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
// });

Route::middleware(['auth', 'role:kepala_sekolah'])->group(function () {});
Route::resource('/account', AuthController::class);

Route::get('/report/peminjaman', [ReportController::class, 'report_peminjaman']);
Route::get('/report/pengembalian', [ReportController::class, 'report_pengembalian']);
Route::get('/report/buku', [ReportController::class, 'report_buku']);
Route::get('/report/anggota', [ReportController::class, 'report_anggota']);

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::Post('/login', [AuthController::class, 'authenticate']);
Route::Post('/logout', [AuthController::class, 'logout']);

Route::get('/demo/create', [AuthController::class, 'demo_create']);
