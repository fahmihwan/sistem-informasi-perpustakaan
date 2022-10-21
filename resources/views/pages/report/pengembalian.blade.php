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
                    <h1 class="m-0">Pengembalian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Pengembalian</li>
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
                            <div class="d-flex justify-content-between" style="width: 100%">
                                <h3 class="card-title">List Pengembalian</h3>
                                <a href="/transaksi/pengembalian/create" type="button" class="btn btn-sm btn-primary">
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
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Denda</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->anggota->nama }} - [{{ $item->anggota->role->nama }}] </td>
                                            <td>{{ $item->buku->judul }}</td>
                                            <td>Rp. {{ $item->denda }} </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="d-flex justify-content-center">
                                                {{-- <a href="/anggota/role/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning mr-2">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a> --}}
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
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Denda</th>
                                        <th>Tgl Pengembalian</th>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/anggota/role" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="role" placeholder="input Role" autocomplete="off" required
                                aria-describedby="role_alert">
                            @error('nama')
                                <div id="role_alert" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
