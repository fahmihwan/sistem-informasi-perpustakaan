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
                    <h1 class="m-0">Edit Buku</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="/buku">Buku</a></li>
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
                <div class="col-md-10 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                Form Buku
                                <a href="/buku"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="/buku/{{ $buku->id }}" method="PUT">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 px-4">
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" name="judul"
                                                class="form-control @error('judul') is-invalid @enderror" id="title"
                                                placeholder="input judul" autocomplete="off" required
                                                value="{{ old('judul', $buku->judul) }}">
                                            @error('judul')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Slug</label>
                                            <input type="text" name="slug"
                                                class="form-control @error('slug') is-invalid @enderror" id="slug"
                                                placeholder="input slug" autocomplete="off" required
                                                aria-describedby="kategori_alert" value="{{ old('slug', $buku->slug) }}">
                                            @error('slug')
                                                <div id="kategori_alert" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <select name="pengarang_id"
                                                class="form-control select2 @error('pengarang_id') is-invalid @enderror"
                                                style="width: 100%;">
                                                @foreach ($pengarangs as $item)
                                                    @if (isset($buku->id))
                                                        <option value="{{ $buku->pengarang_id }}"
                                                            {{ $buku->pengarang_id == $buku->pengarang_id ? 'selected' : '' }}>
                                                            {{ $item->nama }}
                                                    @endif
                                                    <option value="{{ $item->id }}"
                                                        {{ old('pengarang_id') == $buku->pengarang_id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pengarang_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <select name="penerbit_id"
                                                class="form-control select2 @error('penerbit_id') is-invalid @enderror"
                                                style="width: 100%;">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($penerbits as $item)
                                                    @if (old('penerbit_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('penerbit_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-6 px-4">
                                        <div class="form-group">
                                            <label>Tahun Terbit</label>
                                            <select name="tahun_terbit_id"
                                                class="form-control select2  @error('tahun_terbit_id') is-invalid @enderror"
                                                style="width: 100%;">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($tahun_terbits as $item)
                                                    @if (old('tahun_terbit_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('tahun_terbit_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Rak</label>
                                            <select name="rak_id"
                                                class="form-control select2 @error('rak_id') is-invalid @enderror"
                                                style="width: 100%;">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($raks as $item)
                                                    @if (old('rak_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('rak_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori_id"
                                                class="form-control select2 @error('kategori_id') is-invalid @enderror"
                                                style="width: 100%;">
                                                <option disabled selected="selected"> -- select -- </option>
                                                @foreach ($kategoris as $item)
                                                    @if (old('kategori_id') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Qty</label>
                                            <input type="number" name="qty"
                                                class="form-control @error('qty') is-invalid @enderror"
                                                placeholder="input qty" autocomplete="off" required
                                                value="{{ old('qty') }}">
                                            @error('qty')
                                                <div id="qty" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
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
        });

        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>
@endsection
