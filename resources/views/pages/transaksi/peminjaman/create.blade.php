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
                    <h1 class="m-0">Tambah Peminjaman </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/transaksi/peminjaman">Peminjaman</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 ">
                    @if ($errors->any())
                        <div class="alert alert-danger p-0" role="alert">
                            <ul class="my-2">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                Form Buku
                                <a href="/transaksi/peminjaman"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/transaksi/peminjaman" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 px-4">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role_id"
                                                class="form-control select2 @error('role_id') is-invalid @enderror"
                                                style="width: 100%;" id="role">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($roles as $item)
                                                    @if (old('role_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Anggota</label>
                                            <select name="anggota_id"
                                                class="form-control select2 @error('anggota_id') is-invalid @enderror"
                                                style="width: 100%;" id="anggota" disabled>
                                                <option disabled selected="selected"> -- select -- </option>
                                            </select>
                                            @error('anggota_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                                                    <input type="date" name="tanggal_pinjam"
                                                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                                        id="tgl_pinjam" required value="{{ old('tanggal_pinjam') }}">
                                                    @error('tanggal_pinjam')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tgl_kembali">Tanggal Kembali</label>
                                                    <input type="date" name="tanggal_kembali"
                                                        class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                                        id="tgl_kembali" required value="{{ old('tanggal_kembali') }}"
                                                        readonly>
                                                    @error('tanggal_kembali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_kembali">Buku</label>
                                            <select name="buku_id"
                                                class="form-control select2 @error('buku_id') is-invalid @enderror"
                                                style="width: 100%;" id="buku" name="buku">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($books as $item)
                                                    @if (old('buku_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->judul }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                                    @endif
                                                @endforeach
                                                @error('buku_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </select>
                                        </div>

                                        <div id='detail-buku'>

                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
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

            $('#role').change(function() {
                const id = $(this).val()
                $.ajax({
                    url: `/transaksi/${id}/anggota`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        let text = ''
                        if (res.status == 200) {
                            $('#anggota').attr('disabled', false)
                            res.data.forEach(e => {
                                text +=
                                    `<option value="${e.id}" selected>${e.nama}</option>`
                            });
                            $('#anggota').html(text)
                        }
                    }
                });
            })

            $('#buku').change(function() {
                const id = $(this).val()
                let text = '';
                $.ajax({
                    url: `/transaksi/${id}/buku`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        if (res.status == 200) {
                            let data = res.data

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

            $('#tgl_pinjam').change(function() {
                let date = new Date($(this).val())
                date.setDate(date.getDate() + 7);
                let set_date = date.toISOString().slice(0, 10);
                let sortDate = set_date.split('/')
                let tgl_kembali = sortDate.reverse().join('-')
                $('#tgl_kembali').val(tgl_kembali)
            })

            // function renderInputDate(date) {
            //     date.setDate(date.getDate() + 7);
            //     let set_date = date.toLocaleDateString();
            //     let sortDate = set_date.split('/')
            //     let tgl_kembali = `${sortDate[2]}-${sortDate[1]}-${sortDate[0]}`
            //     return tgl_kembali;
            // }


        });
    </script>
@endsection
