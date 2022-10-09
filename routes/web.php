<?php

use App\Http\Controllers\buku\BukuController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\master_buku\PenerbitController;
use App\Http\Controllers\master_buku\PengarangController;
use App\Http\Controllers\master_buku\RakController;
use App\Http\Controllers\master_buku\Tahun_terbitController;
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
Route::resource('/master-buku/pengarang', PengarangController::class);
Route::resource('/master-buku/penerbit', PenerbitController::class);
Route::resource('/master-buku/rak', RakController::class);
Route::resource('/master-buku/tahun-terbit', Tahun_terbitController::class);
Route::resource('/buku', BukuController::class);
