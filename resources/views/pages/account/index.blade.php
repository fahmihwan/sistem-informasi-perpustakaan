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
                    <h1 class="m-0">Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                                <h3 class="card-title">List Account</h3>
                                <a href="/account/create" type="button" class="btn btn-sm btn-primary">
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
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Hak Akses</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->credential->nama }}</td>
                                            <td>{{ $item->credential->telp }}</td>
                                            <td>{{ $item->hak_akses }}</td>
                                            <td class="d-flex">
                                                <a href="/account/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning mr-2">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="/account/{{ $item->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                        onClick="return confirm('Are you sure?')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Hak Akses</th>
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
