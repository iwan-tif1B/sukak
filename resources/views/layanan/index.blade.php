@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Data Layanan</h6>
                    <a href="{{ route('m-layanan.create') }}" class="btn btn-primary btn-sm m-2">Tambah Layana</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Layanan</th>
                                    <th scope="col">Keterangna</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $rows)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $rows->nama_layanan }}</td>
                                        <td>{{ $rows->deskripsi_layanan }}</td>
                                        <td>
                                            <form action="{{ route('m-layanan.destroy', $rows->id_layanan) }}" method="post">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('m-layanan.edit', $rows->id_layanan) }}"
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
