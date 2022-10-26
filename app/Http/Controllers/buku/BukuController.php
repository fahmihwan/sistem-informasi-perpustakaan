<?php

namespace App\Http\Controllers\buku;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use App\Models\Tahun_terbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Buku::with([
            'pengarang:id,nama',
            'penerbit:id,nama',
            'rak:id,nama',
            'tahun_terbit:id,nama',
            'kategori:id,nama',
        ])->latest()->get();

        return view('pages.buku.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengarangs = Pengarang::latest()->get();
        $penerbits = Penerbit::latest()->get();
        $tahun_terbits = Tahun_terbit::latest()->get();
        $raks = Rak::latest()->get();
        $kategoris = Kategori::latest()->get();
        return view('pages.buku.create', [
            'pengarangs' => $pengarangs,
            'penerbits' => $penerbits,
            'tahun_terbits' => $tahun_terbits,
            'raks' => $raks,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated =   $request->validate([
            'judul' => 'required',
            'slug' => 'required|unique:bukus',
            'pengarang_id' => 'required|numeric',
            'penerbit_id' => 'required|numeric',
            'tahun_terbit_id' => 'required|numeric',
            'rak_id' => 'required|numeric',
            'kategori_id' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        $validated['qty_peminjaman'] = 0;

        Buku::create($validated);
        return redirect('/buku');
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
    public function edit($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        $pengarangs = Pengarang::latest()->get();
        $penerbits = Penerbit::latest()->get();
        $tahun_terbits = Tahun_terbit::latest()->get();
        $raks = Rak::latest()->get();
        $kategoris = Kategori::latest()->get();

        return view('pages.buku.edit', [
            'buku' => $buku,
            'pengarangs' => $pengarangs,
            'penerbits' => $penerbits,
            'tahun_terbits' => $tahun_terbits,
            'raks' => $raks,
            'kategoris' => $kategoris,
        ]);
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
        Buku::where('slug', $id)->delete();
        return redirect('/buku');
    }
}
