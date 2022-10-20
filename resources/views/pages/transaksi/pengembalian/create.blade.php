@extends('component.main')

@section('style')
    <!-- DataTables -->
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengembalian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/transaksi/pengembalian">Pengembalian</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        {{-- <div class="alert alert-danger"> Gagal </div> --}}
        @if ($errors->any())
            <div class="alert alert-danger p-0" role="alert">
                <ul class="my-2">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                Form Buku
                                <a href="/transaksi/pengembalian"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/transaksi/pengembalian" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 px-4">
                                        <div class="form-group">
                                            <label>Anggota</label>
                                            <select name="anggota_id"
                                                class="form-control select2 @error('anggota_id') is-invalid @enderror"
                                                style="width: 100%;" id="anggota" required>
                                                <option disable selected="selected"> -- select -- </option>
                                                @foreach ($items as $item)
                                                    @if (old('anggota_id') == $item->id)
                                                        <option value="{{ $item->anggota->id }}" selected>
                                                            {{ $item->anggota->nama }} [{{ $item->anggota->role->nama }}]
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->anggota->id }}">
                                                            {{ $item->anggota->nama }} [{{ $item->anggota->role->nama }}]
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('anggota_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_pengembalian">Tanggal Pengembalian</label>
                                            <input type="date" name="tanggal_pengembalian"
                                                class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                                id="tgl_pengembalian" required value="{{ old('tanggal_pengembalian') }}">
                                            @error('tanggal_pengembalian')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="denda" readonly id="input_denda">
                                        <input type="hidden" name="buku_id" readonly id="input_buku_id">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Kembalikan Sekarang!</button>
                                        </div>

                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            Status Peminjaman
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-7 col-lg-5">
                                    <table>
                                        <tr>
                                            <td style="width: 70px">status</td>
                                            <td> : <span class="" id="status"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Pinjam</td>
                                            <td> : <span id="pinjam" class=""></span></td>
                                        </tr>
                                        <tr>
                                            <td>Kembali</td>
                                            <td> : <span id="kembali" class=""></span></td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-7 col-sm-5 col-lg-7  d-flex align-items-center">
                                    <div class="d-none d-xl-block position-absolute rounded-pill"
                                        style="width: 4px; height: 97px; top: 0; left: 0; transform: translateY(-10px) translateX(-26px); background-color: rgb(240, 240, 240);   ">
                                    </div>
                                    <h2>Denda : <span class="text-danger" id="denda"></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id='detail-buku'>

                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection


@section('script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()

            $('#anggota').change(function() {
                const id = $(this).val()
                let text = '';
                $.ajax({
                    url: `/transaksi/${id}/pengembalian`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        if (res.status == 200) {
                            $('#pinjam').text(res.data.tanggal_pinjam);
                            $('#kembali').text(res.data.tanggal_kembali);
                            $('#status').text(res.data.status);
                            $('#input_buku_id').val(res.data.buku_id)
                            let data = res.data.buku
                            text = `<div class="card">
                                              <div class="card-header bg-info">
                                                    Detail Buku
                                                </div>
                                                <div class="card-body">
                                                    <table class="">
                                                        <tr>
                                                            <td style="width: 100px">Judul </td>
                                                            <td id="judul">: ${data.judul} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Slug </td>
                                                            <td>: ${data.slug} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pengarang </td>
                                                            <td>: ${data.pengarang.nama} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penerbit </td>
                                                            <td>: ${data.penerbit.nama} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rak</td>
                                                            <td>: ${data.rak.nama} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tahun Terbit</td>
                                                            <td>: ${data.tahun_terbit.nama} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kategori</td>
                                                            <td>: ${data.kategori.nama} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sisa Stok</td>
                                                            <td>: ${data.qty - data.qty_peminjaman} </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>`
                        }

                        $(`#detail-buku`).html(text)
                    }
                });
            })

            $('#tgl_pengembalian').change(function() {
                const date = $(this).val()
                const anggota_id = $('#anggota').val()

                $.ajax({
                    url: `/transaksi/${anggota_id}/${date}/pengembalian`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 404) {
                            alert(res.message)
                        }

                        if (res.status == 200) {
                            $('#input_denda').val(res.data)
                            $('#denda').text(`Rp . ${res.data}`)
                        }
                    }
                })
            })


        });
    </script>
@endsection
