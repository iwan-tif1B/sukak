<!DOCTYPE html>
<html>
<head>
    <title>Halaman Cetak</title>
    <style>
        /* Gaya untuk halaman cetak */
        
        table {
                visibility: visible;
                width: 100%;
                margin: 0 auto;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
    </style>
</head>
<body>
    <!-- Tambahkan tombol cetak di atas tabel jika diperlukan -->
    <button onclick="window.print()">Cetak</button>

    <table width="100%">
        <thead>
            <tr>
                <th >No</th>
                <th >Waktu Registrasi</th>
                <th >No Registrasi</th>
                <th >No Rekam Medis</th>
                <th >Nama Pasien</th>
                <th >Jenis Kelamin</th>
                <th >Tanggal Lahir</th>
                <th >Jenis Registrasi</th>
                <th >Jenis Pembayaran</th>
                <th >Status Registrasi</th>
                <th >Jenis Layanan</th>
                <th >Waktu Mulai Layanan</th>
                <th >Waktu Selesai Layanan</th>
                <th >Petugas Pendaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $rows)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rows->created_at }}</td>
                    <td>{{ $rows->no_registrasi }}</td>
                    <td>{{ $rows->no_rekam_medis }}</td>
                    <td>{{ $rows->nama_pasien }}</td>
                    <td>{{ $rows->jenis_kelamin }}</td>
                    <td>{{ $rows->tanggal_lahir }}</td>
                    <td>{{ $rows->jenis_registrasi }}</td>
                    <td>{{ $rows->jenis_pembayaran }}</td>
                    <td>{{ $rows->status_registrasi }}</td>
                    <td>{{ $rows->nama_layanan }}</td>
                    <td>{{ $rows->waktu_mulai_layanan }}</td>
                    <td>{{ $rows->waktu_selesai_layanan }}</td>
                    <td>{{ $rows->nama_petugas }}</td>

                </tr>
            @endforeach



        </tbody>
    </table>
</body>
</html>
