<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Pengembalian::with([
            'buku:id,judul',
            'anggota:id,nama,role_id',
            'anggota.role:id,nama'
        ])->latest()->get();

        return view('pages.transaksi.pengembalian.index', [
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

        $peminjaman =  Peminjaman::with(['anggota.role'])->where('status', 'dipinjam')->get();
        return view(
            'pages.transaksi.pengembalian.create',
            [
                'items' => $peminjaman
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
        $validator =  $request->validate([
            "anggota_id" => 'required',
            "tanggal_pengembalian" => "required",
            "denda" => "required",
            "buku_id" => "required",
        ]);

        try {
            DB::beginTransaction();

            Peminjaman::where('anggota_id', $request->anggota_id)->update(['status' => 'dikembalikan']);
            $validator["petugas_id"] = auth()->user()->id;
            Pengembalian::create($validator);

            $buku = Buku::where('id', $request->buku_id);
            $buku->update([
                'qty_peminjaman' => $buku->first()->qty_peminjaman - 1
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }


        return redirect('/transaksi/pengembalian');
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
        //
    }

    public function ajax_detail_pengembalian($id)
    {
        $peminjaman = Peminjaman::with([
            'buku.pengarang:id,nama',
            'buku.penerbit:id,nama',
            'buku.kategori:id,nama',
            'buku.tahun_terbit:id,nama',
            'buku.rak:id,nama',
        ])->where([
            ['status', '=', 'dipinjam'],
            ['anggota_id', '=', $id]
        ])->first();

        return response()->json([
            'status' => 200,
            'data' => $peminjaman
        ]);
    }


    public function cek_denda($anggota_id, $chooseDate)
    {

        $tanggal = Peminjaman::where('anggota_id', $anggota_id)->first();

        if ($tanggal->tanggal_pinjam > $chooseDate) {
            return response()->json([
                'status' => 404,
                'message' => 'tanggal tidak boleh melebihi batas'
            ]);
        }
        $result = 0;
        if ($chooseDate >= $tanggal->tanggal_pinjam && $chooseDate <= $tanggal->tanggal_kembali) {
            return response()->json([
                'status' => 200,
                'data' => $result
            ]);
        }
        $late_date = Carbon::parse($tanggal->tanggal_kembali)->diffInDays(Carbon::parse($chooseDate));

        if ($late_date >= 3) {
            $punishmentCount = floor($late_date / 3);
            $result = 2000 * $punishmentCount;
        }
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }
}
