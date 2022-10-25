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
        <h4>Laporan Pengembalian</h4> <br>
        <h6 style="font-size: 12px;">Perpustakaan SMP Muhammadiyah 2 Gamping</h6>
        <p style="font-size: 12px">
            Jl. Godean, Gamping, Sleman, Area Sawah, Nogotirto, Sleman, Kabupaten Sleman, Provinsi Daerah Istimewa
            Yogyakarta, 55592.
        </p>
        <p style="margin: 5px">Periode : {{ request('start_date') }} sampai {{ request('end_date') }}</p>

    </div>
    <div class="container">

        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Denda</th>
                        <th>Tgl Pengembalian</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->anggota->nama }} - [{{ $item->anggota->role->nama }}] </td>
                            <td>{{ $item->buku->judul }}</td>
                            <td>Rp. {{ $item->denda }} </td>
                            <td>{{ $item->tanggal_pengembalian }}</td>
                            <td>{{ $item->petugas->credential->nama }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
