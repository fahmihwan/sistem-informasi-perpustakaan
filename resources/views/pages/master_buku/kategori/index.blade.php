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
                    <h1 class="m-0">Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active"><a href="#">Kategori</a></li> --}}
                        <li class="breadcrumb-item active">Kategori</li>
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
                                <h3 class="card-title">List Kategori </h3>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fa-solid fa-plus"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="d-flex">
                                                <a href="/master-buku/kategori/{{ $item->id }}/edit"
                                                    class="btn btn-sm btn-warning mr-2">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="/master-buku/kategori/{{ $item->id }}" method="post">
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
                                        <th>Kategori</th>
                                        <th>Created</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/master-buku/kategori" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <label for="kategori">Edit Kategori</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="kategori" placeholder="input kategori" autocomplete="off" required
                                aria-describedby="kategori_alert">
                            @error('nama')
                                <div id="kategori_alert" class="invalid-feedback">
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
