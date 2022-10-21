@extends('component.main')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Peminjaman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">peminjaman</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid ">
            <div class="card ">
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-4 ">
                            <form action="" method="GET" class="d-flex ">
                                <div class="form-group ml-3">
                                    <label for="">start date</label>
                                    <input type="date" name="start_date" required class="form-control"
                                        value="{{ request('start_date') }}">
                                </div>
                                <div class="form-group ml-3">
                                    <label for="">end date</label>
                                    <input type="date" name="end_date" required class="form-control"
                                        value="{{ request('end_date') }}">
                                </div>
                                <div class="d-flex ml-3 " style="margin-top:30px;">
                                    <button type="submit" class="btn btn-primary" style="height: 40px">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                    <button name="print" value="ok" class="btn btn-info ml-2 ms-2"
                                        style="height: 40px">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                    <a href="/report/pemin" class="btn btn-warning ml-2 ms-2" style="height: 40px">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">


                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between" style="width: 100%">
                                <h3 class="card-title">List Peminjaman </h3>
                                <!-- Button trigger modal -->
                                <a href="/transaksi/peminjaman/create" type="button" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $item->anggota->nama }} ({{ $item->anggota->role->nama }})</td>
                                            <td>{{ $item->buku->judul }}</td>
                                            <td>{{ $item->tanggal_pinjam }}</td>
                                            <td>{{ $item->tanggal_kembali }}</td>
                                            <td>
                                                <div
                                                    class="badge {{ $item->status == 'dipinjam' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $item->status }}</div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                {{-- <a href="/transaksi/peminjaman/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning mr-2">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a> --}}
                                                {{-- <form action="/transaksi/peminjaman/{{ $item->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                        onClick="return confirm('Are you sure?')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form> --}}
                                                <a href="" class="btn btn-sm btn-info">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@endsection
