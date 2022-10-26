<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        // 2022-11-05


        function sumPeminjaman($month)
        {
            return Peminjaman::whereMonth('tanggal_pinjam', date($month))
                ->whereYear('tanggal_pinjam', date('Y'))
                ->count();
        }
        function sumPengembalian($month)
        {
            return Pengembalian::whereMonth('tanggal_pengembalian', date($month))
                ->whereYear('tanggal_pengembalian', date('Y'))
                ->count();
        }

        $array_peminjaman = []; //value 12 month of year, etc : 0,0,0,0,12,23,0,0,0 dst until 12 array data
        $array_pengembalian = [];
        for ($i = 1; $i <= 12; $i++) {
            $array_peminjaman[] = sumPeminjaman($i) != null ? sumPeminjaman($i) : 0;
            $array_pengembalian[] = sumPengembalian($i) != null ? sumPengembalian($i) : 0;
        }

        $sedang_meminjam = Peminjaman::with(['anggota:id,nama,role_id', 'anggota.role:id,nama'])
            ->select(['tanggal_kembali', 'anggota_id'])
            ->where('status', 'dipinjam')
            ->get();

        return view('pages.dashboard.index', [
            'jml_buku' => Buku::count(),
            'jml_anggota' => Anggota::count(),
            'jml_peminjaman' => Peminjaman::whereMonth('tanggal_pinjam', date('m'))->whereYear('tanggal_pinjam', date('Y'))->count(),
            'jml_jatuh_tempo' => Peminjaman::where([['status', '=', 'dipinjam'], ['tanggal_kembali', '<', date('Y-m-d')]])->whereYear('tanggal_pinjam', date('Y'))->count(),
            'sedang_meminjam' => $sedang_meminjam,
            'chart_peminjaman' => $array_peminjaman,
            'chart_pengembalian' => $array_pengembalian
        ]);
    }
    public function show_sendang_meminjam($id)
    {
        $items = Peminjaman::with([
            'anggota',
            'buku',
            'anggota.role',
            'buku.kategori:id,nama',
            'buku.penerbit:id,nama',
            'buku.pengarang:id,nama',
            'buku.rak:id,nama',
            'buku.tahun_terbit:id,nama',
            'buku.kategori:id,nama'
        ])
            ->where('anggota_id', $id)->first();

        return view('pages.dashboard.show', [
            'item' => $items
        ]);
    }

    public function show_jatuh_tempo()
    {
        $items = Peminjaman::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama',
            'petugas:id,credential_id',
            'petugas.credential:id,nama'
        ])
            ->where([['status', '=', 'dipinjam'], ['tanggal_kembali', '<', date('Y-m-d')]])
            ->latest()->get();
        return view('pages.dashboard.jatuh_tempo', [
            'items' => $items
        ]);
    }

    public function show_peminjaman_bulan_ini()
    {
        $items = Peminjaman::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama',
            'petugas:id,credential_id',
            'petugas.credential:id,nama'
        ])
            ->whereMonth('tanggal_pinjam',  date('m'))
            ->whereYear('tanggal_pinjam', date('Y'))
            ->latest()->get();

        // return $items;
        return view('pages.dashboard.bulan_ini', [
            'items' => $items
        ]);
    }
}
