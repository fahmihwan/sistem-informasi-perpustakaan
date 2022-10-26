<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="content">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                Form Buku
                                <a href="/account"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/account" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 px-4">
                                        <div class="form-group">
                                            <label for="title">Nama</label>
                                            <input type="text" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror" id="title"
                                                placeholder="input nama" autocomplete="off" required
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Telp</label>
                                            <input type="number" name="telp"
                                                class="form-control @error('telp') is-invalid @enderror" id="title"
                                                placeholder="Telp" autocomplete="off" required
                                                value="{{ old('telp') }}">
                                            @error('telp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="" for="title">Hak Akses</label>
                                            <div class="">
                                                <div class="icheck-primary mr-4 d-inline">
                                                    <input type="radio" name="hak_akses" value="petugas"
                                                        id="radioDanger1">
                                                    <label class="font-weight-normal" for="radioDanger1">Petugas</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" name="hak_akses" value="kepala_sekolah"
                                                        id="radioDanger2">
                                                    <label class="font-weight-normal" for="radioDanger2"> Kepala
                                                        Sekolah</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-4">
                                        <div class="form-group">
                                            <label for="title">Username</label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="title" placeholder="input username" autocomplete="off" required
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Password</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="password"
                                                    class="form-control confirm_password @error('password') is-invalid @enderror"
                                                    placeholder="password" autocomplete="off"
                                                    value="{{ old('password') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text password-hidden" id="password-hidden"
                                                        style="cursor: pointer">
                                                        <i id="eye" class="eye fa-regular fa-eye"></i>
                                                        <i id="eye-slash" style="display: none"
                                                            class="eye-slash fa-regular fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <div id="password" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Confirm Password</label>
                                            <div class="input-group mb-3 sssss">
                                                <input type="text"
                                                    class="form-control @error('confirm_password')
                                                        is-invalid
                                                @enderror confirm_password   "
                                                    placeholder="confirm password" name="confirm_password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text password-hidden"
                                                        id="password-hidden" style="cursor: pointer">
                                                        <i id="eye" class="eye fa-regular fa-eye"></i>
                                                        <i id="eye-slash" style="display: none"
                                                            class="eye-slash fa-regular fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                @error('confirm_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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

</body>

</html>
