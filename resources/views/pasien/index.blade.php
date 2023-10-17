@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Data Pasien</h6>
                    <a href="{{ route('m-pasien.create') }}" class="btn btn-primary btn-sm m-2">Tambah Petugas</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No Rekam Medis</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $rows)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $rows->no_rekam_medis }}</td>
                                        <td>{{ $rows->nama_pasien }}</td>
                                        <td>{{ $rows->jenis_kelamin }}</td>
                                        <td>{{ $rows->tanggal_lahir }}</td>
                                        <td>
                                            <form action="{{ route('m-pasien.destroy', $rows->id_pasien) }}" method="post">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('m-pasien.edit', $rows->id_pasien) }}"
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
