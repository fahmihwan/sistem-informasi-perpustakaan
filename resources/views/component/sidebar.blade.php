<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"> Perpustakaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->username }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="fa-solid fa-house"></i> &nbsp;
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->user()->hak_akses == 'petugas')
                    <li class="nav-header">Master</li>
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            <i class="fa-solid fa-book-open"></i> &nbsp;
                            <p>
                                Master Buku
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="/master-buku/kategori" class="nav-link">
                                    <i class="fa-solid fa-layer-group"></i> &nbsp;
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/master-buku/pengarang" class="nav-link">
                                    <i class="fa-solid fa-user-tie"></i> &nbsp;
                                    <p>Pengarang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/master-buku/penerbit" class="nav-link">
                                    <i class="fa-solid fa-building"></i> &nbsp;
                                    <p>Penerbit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/master-buku/rak" class="nav-link">
                                    <i class="fa-solid fa-warehouse"></i> &nbsp;
                                    <p>Rak</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/master-buku/tahun-terbit" class="nav-link">
                                    <i class="fa-solid fa-calendar-days"></i> &nbsp;
                                    <p>Tahun Terbit</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/buku" class="nav-link">
                            <i class="fa-solid fa-book"></i> &nbsp;
                            <p>
                                Buku
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">anggota</li>
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            <i class="fa-solid fa-users"></i> &nbsp;
                            <p>
                                Anggota
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="/anggota/role" class="nav-link">
                                    <i class="fa-solid fa-key"></i> &nbsp;
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/anggota/anggota" class="nav-link">
                                    <i class="fa-solid fa-user-group"></i> &nbsp;
                                    <p>Anggota</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="/transaksi/peminjaman" class="nav-link">
                            <i class="fa-solid fa-cart-plus"></i> &nbsp;
                            <p>
                                Peminjaman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaksi/pengembalian" class="nav-link">
                            <i class="fa-solid fa-people-carry-box"></i> &nbsp;
                            <p>
                                Pengembalian
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hak_akses == 'kepala_sekolah')
                    <li class="nav-header">Report</li>
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Report
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/report/peminjaman" class="nav-link ">
                                    <i class="fa-solid fa-cart-plus"></i> &nbsp;
                                    <p>Peminjaman</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/report/pengembalian" class="nav-link">
                                    <i class="fa-solid fa-people-carry-box"></i> &nbsp;
                                    <p>Pengembalian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/report/buku" class="nav-link">
                                    <i class="fa-solid fa-book-open"></i> &nbsp;
                                    <p>Buku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/report/anggota" class="nav-link">
                                    <i class="fa-solid fa-users"></i> &nbsp;
                                    <p>Anggota</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
