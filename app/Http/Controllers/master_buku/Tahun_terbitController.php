<?php

namespace App\Http\Controllers\master_buku;

use App\Http\Controllers\Controller;
use App\Models\Tahun_terbit;
use Illuminate\Http\Request;

class Tahun_terbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Tahun_terbit::latest()->get();
        return view('pages.master_buku.tahun_terbit.index', [
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'nama' => 'required|numeric|min:4'
        ]);

        Tahun_terbit::create($validated);
        return redirect('/master-buku/tahun-terbit');
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
        $item = Tahun_terbit::where('id', $id)->first();
        return view('pages.master_buku.tahun_terbit.edit', [
            'item' => $item
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
        $validated = $request->validate([
            'nama' => 'required|numeric|min:4',
        ]);

        Tahun_terbit::where('id', $id)->update($validated);
        return redirect('/master-buku/tahun-terbit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tahun_terbit::destroy($id);
        return redirect('/master-buku/tahun-terbit');
    }
}
