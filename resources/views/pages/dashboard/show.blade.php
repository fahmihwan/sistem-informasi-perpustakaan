@extends('component.main')

@section('style')
@endsection

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail peminjaman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Detail Peminjaman</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center  d-flex justify-content-center">
                                <div class="border d-flex justify-content-center align-items-center rounded-pill bg-secondary"
                                    style="width: 60px; height: 60px;">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                            </div>

                            <h3 class="profile-username text-center">{{ $item->anggota->nama }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Telp </b> <a class="float-right">{{ $item->anggota->telp }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Anggota </b> <a class="float-right">{{ $item->anggota->role->nama }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Pinjam</b> <a class="float-right">{{ $item->tanggal_pinjam }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl kembali</b> <a class="float-right">{{ $item->tanggal_kembali }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right badge bg-danger">{{ $item->status }}</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                Detail Buku Peminjaman
                                <a href="/dashboard"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <table class="table table-striped">
                                    <tr>
                                        <td style="width: 140px">Judul</td>
                                        <td>{{ $item->buku->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengarang</td>
                                        <td>{{ $item->buku->pengarang->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td>{{ $item->buku->penerbit->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Terbit</td>
                                        <td>{{ $item->buku->tahun_terbit->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>{{ $item->buku->kategori->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rak</td>
                                        <td>{{ $item->buku->rak->nama }}</td>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('script')
    <!-- DataTables  & Plugins -->
@endsection
