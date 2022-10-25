<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use PDF;

class ReportController extends Controller
{
    public function report_peminjaman()
    {

        if (request('print')) {
            $data = Peminjaman::latest()->filter(request(['start_date', 'end_date']));
            if ($data->count() == 0) {
                return redirect('/report/peminjaman')->withErrors('Data tanggal ' . request('start_date') . ' sampai ' . request('end_date') . ' tidak ada');
            }
            $pdf = PDF::loadview('pages.print.print_date.peminjaman', ['items' => $data->get()]);
            return $pdf->download('laporan_peminjaman.pdf');
        }

        // // search
        if (request('start_date')) {
            $data = Peminjaman::latest()->filter(request(['start_date', 'end_date']))->get();
        } else {
            $data = Peminjaman::with([
                'buku:id,judul',
                'anggota:id,nama,role_id',
                'anggota.role:id,nama',
                'petugas:id,credential_id',
                'petugas.credential:id,nama',
            ])->latest()->get();
        }
        return view('pages.report.peminjaman', [
            'items' => $data
        ]);
    }



    public function report_pengembalian()
    {
        if (request('print')) {
            $data = Pengembalian::latest()->filter(request(['start_date', 'end_date']));
            if ($data->count() == 0) {
                return redirect('/report/peminjaman')->withErrors('Data tanggal ' . request('start_date') . ' sampai ' . request('end_date') . ' tidak ada');
            }

            $pdf = PDF::loadview('pages.print.print_date.pengembalian', ['items' => $data->get()]);
            return $pdf->download('laporan_pengembalian.pdf');
        }

        // // search
        if (request('start_date')) {
            $data = Pengembalian::latest()->filter(request(['start_date', 'end_date']))->get();
        } else {
            $data = Pengembalian::with([
                'buku:id,judul',
                'anggota:id,nama,role_id',
                'anggota.role:id,nama',
                'petugas:id,credential_id',
                'petugas.credential:id,nama',
            ])->latest()->get();
        }

        return view('pages.report.pengembalian', [
            'items' => $data
        ]);
    }


    public function report_buku()
    {

        $buku = Buku::with([
            'pengarang:id,nama',
            'penerbit:id,nama',
            'rak:id,nama',
            'tahun_terbit:id,nama',
            'kategori:id,nama',
        ])->latest()->get();

        if (request('print')) {
            $pdf = PDF::loadview('pages.print.print_one.buku', ['items' => $buku]);
            return $pdf->download('laporan_buku.pdf');
        }

        return view('pages.report.buku', [
            'items' => $buku
        ]);
    }
    public function report_anggota()
    {
        $items = Anggota::with('role')->latest()->get();
        if (request('print')) {
            $pdf = PDF::loadview('pages.print.print_one.anggota', ['items' => $items]);
            return $pdf->download('laporan_anggota.pdf');
        }

        return view('pages.report.anggota', [
            'items' => $items
        ]);
    }
}
