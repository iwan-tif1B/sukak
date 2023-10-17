@extends('layouts.main')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Form Tambah Data Petugas</h6>
                    <form action="{{ route('m-petugas.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas">
                                @if ($errors->first('nama_petugas'))
                                    <small class="text-danger"> Nama Petugas Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jabatan" name="jabatan">
                                @if ($errors->first('jabatan'))
                                    <small class="text-danger"> Jabatan Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="departemen" class="col-sm-2 col-form-label">departemen</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="departemen" name="departemen">
                                @if ($errors->first('departemen'))
                                    <small class="text-danger"> Departemen Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username">
                                @if ($errors->first('username'))
                                    <small class="text-danger"> Username Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="passwrod" class="col-sm-2 col-form-label">passwrod</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="passwrod" name="password">
                                @if ($errors->first('password'))
                                    <small class="text-danger"> Password Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="passwrod" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="role" id="role" class="form-control">
                                    <option value="">Pilih Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Petugas</option>
                                </select>
                                @if ($errors->first('role'))
                                    <small class="text-danger"> Role Tidak Boleh Kosong</small>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('m-petugas.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
