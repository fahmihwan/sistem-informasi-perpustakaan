@extends('component.main')

@section('style')
@endsection

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Rak</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/master-buku/rak">Rak</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                Form Pengarang
                                <a href="/master-buku/rak"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/master-buku/rak/{{ $item->id }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="pengarang">Edit pengarang</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="pengarang"
                                        placeholder="input pengarang" autocomplete="off" required
                                        aria-describedby="pengarang_alert" value="{{ old('nama', $item->nama) }}">
                                    @error('nama')
                                        <div id="pengarang_alert" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
@endsection
