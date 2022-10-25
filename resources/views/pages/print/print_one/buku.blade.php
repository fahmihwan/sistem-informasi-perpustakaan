<!DOCTYPE html>
<html>

<head>
    <title>.</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        .header {
            padding: 20px 0px;
            text-align: center;
        }

        .header h4 {
            font-size: 28px;
        }

        .container {
            /* border: 1px solid black; */
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            padding: 5px;
            border: 0.2px solid rgb(162, 162, 162);
            border-collapse: collapse;
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Laporan Buku</h4> <br>
        <h6 style="font-size: 12px;">Perpustakaan SMP Muhammadiyah 2 Gamping</h6>
        <p style="font-size: 12px">
            Jl. Godean, Gamping, Sleman, Area Sawah, Nogotirto, Sleman, Kabupaten Sleman, Provinsi Daerah Istimewa
            Yogyakarta, 55592.
        </p>
        <p style="margin: 5px">Tanggal : {{ date('d-m-Y') }}</p>

    </div>
    <div class="container">

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                        <th>Qty</th>
                        <th style="width: 10px">Qty Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->pengarang->nama }}</td>
                            <td>{{ $item->penerbit->nama }}</td>
                            <td>{{ $item->tahun_terbit->nama }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>{{ $item->rak->nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->qty_peminjaman }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
