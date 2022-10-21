<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $peminjaman = Peminjaman::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama',
        ])->latest()->get();


        return view('pages.transaksi.peminjaman.index', [
            'items' => $peminjaman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $books = Buku::latest()->get();

        return view(
            'pages.transaksi.peminjaman.create',
            [
                'roles' => $roles,
                'books' => $books
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "anggota_id" => 'required|numeric',
            "buku_id" => 'required|numeric',
            "tanggal_pinjam" => 'required',
            "tanggal_kembali" => 'required',
        ]);

        $cekPeminjaman =  Peminjaman::where([
            ['anggota_id', '=', $request->anggota_id],
            ['status', '=', 'dipinjam'],
        ]);

        if ($cekPeminjaman->count() > 0) {
            return redirect('/transaksi/peminjaman/create')->withErrors('masih ada buku yang belum dikembalikan oleh ' . $cekPeminjaman->first()->anggota->nama);
        }
        try {
            DB::beginTransaction();
            $validated['petugas_id'] = 1;
            $validated['status'] = 'dipinjam';

            $buku  = Buku::where('id', $request->buku_id);
            $qty = $buku->first()->qty;
            $qty_peminjaman = $buku->first()->qty_peminjaman;

            if ($qty_peminjaman >= $qty) {
                throw new Exception("Stok Buku Habis dipinjam.");
            }

            $buku->update(['qty_peminjaman' => $qty_peminjaman += 1]);
            Peminjaman::create($validated);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/transaksi/peminjaman/create')->withErrors($th->getMessage());
        }


        return redirect('/transaksi/peminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();
        $buku = Buku::where('id', $peminjaman->buku_id);
        try {
            DB::beginTransaction();
            $buku->update([
                'qty_peminjaman' => $buku->first()->qty_peminjaman -= 1
            ]);
            Peminjaman::destroy($id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return redirect('/transaksi/peminjaman');
    }

    public function ajax_detail_anggota($id)
    {
        $anggota = Anggota::select(['id', 'nama', 'role_id'])->where('role_id', $id)->get();
        return response()->json([
            'status' => 200,
            'data' => $anggota
        ]);
    }

    public function ajax_detail_buku($id)
    {
        $buku = Buku::with([
            'pengarang:id,nama',
            'penerbit:id,nama',
            'rak:id,nama',
            'tahun_terbit:id,nama',
            'kategori:id,nama',
        ])->where('id', $id)->first();

        return response()->json([
            'status' => 200,
            'data' => $buku
        ]);
    }
}
