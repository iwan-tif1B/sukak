@extends('layouts.main')
@section('content')
    <style>
        tr>th,
        td {
            font-size: 10px
        }

        .btn-group-sm>.btn {
            padding: 0.25rem 0.5rem;
            font-size: 12px;
            border-radius: 0.2rem;
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Transaksi Pelayanan</h6>
                    <a href="{{ route('trx-registrasi.create') }}" class="btn btn-primary btn-sm m-2">Tambah Transaksi
                        Pelayanan</a>
                    <a href="{{ route('registrasi.print') }}" target="_blank" class="btn btn-primary btn-sm m-2">Print Transaksi</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Waktu Registrasi</th>
                                    <th rowspan="2">No Registrasi</th>
                                    <th rowspan="2">No Rekam Medis</th>
                                    <th rowspan="2">Nama Pasien</th>
                                    <th rowspan="2">Jenis Registrasi</th>
                                    <th rowspan="2">Jenis Pembayaran</th>
                                    <th rowspan="2">Status Registrasi</th>
                                    <th rowspan="2">Jenis Layanan</th>
                                    <th colspan="2">Waktu Layanan</th>
                                    <th rowspan="2">Petugas Pendaftar</th>
                                    <th rowspan="2">Act</th>
                                </tr>
                                <tr>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
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
                                        <td>{{ $rows->jenis_registrasi }}</td>
                                        <td>{{ $rows->jenis_pembayaran }}</td>
                                        <td>{{ $rows->status_registrasi }}</td>
                                        <td>{{ $rows->nama_layanan }}</td>
                                        <td>{{ $rows->waktu_mulai_layanan }}</td>
                                        <td>{{ $rows->waktu_selesai_layanan }}</td>
                                        <td>{{ $rows->nama_petugas }}</td>
                                        <td>
                                            <form action="{{ route('trx-registrasi.destroy', $rows->id_registrasi) }}"
                                                method="post">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('registrasi.closing', $rows->id_registrasi) }}"
                                                        class="btn btn-info">Closing</a>
                                                    <a href="{{ route('trx-registrasi.edit', $rows->id_registrasi) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
