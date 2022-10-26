@extends('component.main')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content  ">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jml_buku }}</h3>
                            <p>Buku</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/report/buku" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jml_anggota }}<sup style="font-size: 20px"></sup></h3>
                            <p>Anggota</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/report/anggota" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $jml_peminjaman }}</h3>
                            <p>Peminjaman Bulan ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="/dashboard/list-peminjaman-bulan-ini" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $jml_jatuh_tempo }}</h3>
                            <p>Peminjaman Jatuh Tempo</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/dashboard/list-jatuh-tempo" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Transaksi</h3>
                                <div>
                                    @if (auth()->user()->hak_akses == 'kepala_sekolah')
                                        <a href="/report/peminjaman" class="mr-2"> peminjaman</a>
                                        <a href="/report/pengembalian"> pengembalian</a>
                                    @endif
                                    @if (auth()->user()->hak_akses == 'petugas')
                                        <a href="/transaksi/peminjaman" class="mr-2"> peminjaman</a>
                                        <a href="/transaksi/pengembalian"> pengembalian</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">820</span>
                                    <span>Semua Transaksi</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Grafik Tahun {{ date('Y') }}</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative ">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between d-inline-block ">
                                <span>Sedang Meminjam </span><i class="fa-regular fa-bell"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Nama</span>
                                <span class="font-weight-bold">Jatuh Tempo</span>
                            </div>
                            <div style="height: 242px; overflow:scroll">
                                <table style="width: 100%" class="table ">
                                    @foreach ($sedang_meminjam as $data)
                                        <tr class="p-0">
                                            <td class="py-1 px-0"><a
                                                    href="/dashboard/anggota/{{ $data->anggota->id }}">{{ $data->anggota->nama }}({{ $data->anggota->role->nama }})</a>
                                            </td>
                                            <td class="text-right p-1 px-0">{{ $data->tanggal_kembali }}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script> --}}
    <script>
        /* global Chart:false */

        $(function() {
            'use strict'

            let peminjaman_php = {{ Js::from($chart_peminjaman) }};

            let pengembalian_php = {{ Js::from($chart_pengembalian) }};


            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }
            var mode = 'index'
            var intersect = true

            let createDate = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ];

            var $visitorsChart = $('#visitors-chart')
            // eslint-disable-next-line no-unused-vars
            var visitorsChart = new Chart($visitorsChart, {
                data: {
                    labels: createDate,
                    datasets: [{
                            label: 'Peminjaman',
                            type: 'line',
                            data: peminjaman_php,
                            backgroundColor: 'transparent',
                            borderColor: '#4bde97',
                            pointBorderColor: '#007bff',
                            // pointBorderColor: '#4bde97',
                            // pointBackgroundColor: '#007bff',
                            pointBackgroundColor: '#4bde97',
                            fill: false,
                        },
                        {
                            label: 'Pengembalian',
                            type: 'line',
                            data: pengembalian_php,
                            backgroundColor: 'tansparent',
                            // borderColor: '#ced4da',
                            borderColor: '#da291c',
                            pointBorderColor: '#ced4da',
                            pointBackgroundColor: '#da291c',
                            fill: false
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        // display: true
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: false,
                                // suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })
    </script>
@endsection
