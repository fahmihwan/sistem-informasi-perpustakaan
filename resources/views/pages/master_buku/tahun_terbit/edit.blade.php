@extends('component.main')

@section('style')
@endsection

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Tahunt Terbit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/master-buku/tahun-terbit">Tahun Terbit</a></li>
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
                                Form Tahun Terbit
                                <a href="/master-buku/tahun-terbit"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/master-buku/tahun-terbit/{{ $item->id }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="tahun_terbit">Edit Tahun Terbit</label>
                                    <input type="number" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="tahun_terbit"
                                        placeholder="input tahun terbit" autocomplete="off" required
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="4" aria-describedby="tahun_terbit_alert"
                                        value="{{ old('nama', $item->nama) }}">
                                    @error('nama')
                                        <div id="tahun_terbit_alert" class="invalid-feedback">
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
    <script>
        $(document).ready(function() {
            $('#date-picker').attr('placeholder', `Contoh : ${new Date().getFullYear()}    [4 karakter]`);
        });
    </script>
@endsection
