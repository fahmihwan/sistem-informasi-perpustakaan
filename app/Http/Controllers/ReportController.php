<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report_peminjaman()
    {
        $peminjaman = Peminjaman::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama',
        ])->latest()->get();

        return view('pages.report.peminjaman', [
            'items' => $peminjaman
        ]);
    }
    public function report_pengembalian()
    {
        $items = Pengembalian::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama'
        ])->latest()->get();


        return view('pages.report.pengembalian', [
            'items' => $items
        ]);
    }


    public function report_buku()
    {
        $items = Buku::with([
            'pengarang:id,nama',
            'penerbit:id,nama',
            'rak:id,nama',
            'tahun_terbit:id,nama',
            'kategori:id,nama',
        ])->latest()->get();

        return view('pages.report.buku', [
            'items' => $items
        ]);
    }
    public function report_anggota()
    {
        $items = Anggota::with('role')->latest()->get();
        return view('pages.report.anggota', [
            'items' => $items
        ]);
    }
}
