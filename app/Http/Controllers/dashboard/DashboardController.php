<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // 2022-11-05


        return view('pages.dashboard.index', [
            'jml_buku' => Buku::count(),
            'jml_anggota' => Anggota::count(),
            'jml_peminjaman' => Peminjaman::whereMonth('tanggal_pinjam', date('m'))->count(),
            'jml_jatuh_tempo' => Peminjaman::where([['status', '=', 'dipinjam'], ['tanggal_kembali', '<', date('Y-m-d')]])->count()
        ]);
    }
}
