@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Petugas Entri</h6>
                    <a href="{{ route('m-petugas.create') }}" class="btn btn-primary btn-sm m-2">Tambah Petugas</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Departemen</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $rows)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $rows->nama_petugas }}</td>
                                        <td>{{ $rows->jabatan }}</td>
                                        <td>{{ $rows->departemen }}</td>
                                        <td>{{ $rows->username }}</td>
                                        <td>
                                            @if ($rows->role == 1)
                                                <span class="badge bg-primary">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">Petugas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('m-petugas.edit', $rows->id_petugas) }}"
                                                    class="btn btn-warning m-1">Edit</a>
                                                <form action="{{ route('m-petugas.destroy',$rows->id_petugas) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger m-1">Hapus</button>
                                                </form>
                                                
                                            </div>
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
